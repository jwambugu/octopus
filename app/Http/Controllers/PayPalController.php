<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use DB;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use RuntimeException;


class PayPalController extends Controller
{
    /**
     * Returns the environment to use when making the payment.
     *
     * @return ProductionEnvironment|SandboxEnvironment
     */
    private static function environment(): ProductionEnvironment|SandboxEnvironment
    {
        $environment = config('paypal.current_environment');

        $config = config('paypal.environment');

        return $environment !== 'sandbox' ?
            new ProductionEnvironment($config['production']['client_id'], $config['production']['client_secret']) :
            new SandboxEnvironment($config['sandbox']['client_id'], $config['sandbox']['client_secret']);

    }

    /**
     * Returns a new client to be used to make the API calls
     * @return PayPalHttpClient
     */
    private static function client(): PayPalHttpClient
    {
        $environment = self::environment();

        return new PayPalHttpClient($environment);
    }

    /**
     * Returns an array with the order data for paypal
     * @param int $bookingID
     * @return array
     * @noinspection PhpUndefinedFieldInspection
     */
    #[ArrayShape(['statusCode' => "int", 'results' => "array|string", 'links' => "mixed"])] public static function createOrderRequest(int $bookingID): array
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = self::buildRequestBody($bookingID);

        $client = self::client();
        $response = $client->execute($request);

        return [
            'statusCode' => $response->statusCode,
            'results' => $response->result,
            'links' => $response->result->links
        ];
    }

    /**
     * Returns the data wo be used on the cart section
     * @param int $bookingID
     * @return array
     */
    #[ArrayShape(['intent' => "string", 'application_context' => "array", 'purchase_units' => "array[]"])] private static function buildRequestBody(int $bookingID): array
    {
        $booking = Booking::query()
            ->with('property:id,name', 'unsuccessfulPayments')
            ->find($bookingID, [
                'id', 'uuid', 'number_of_nights', 'property_id'
            ]);

        $amountToPay = $booking->unsuccessfulPayments[0]->amount;
        $amountToPay = number_format($amountToPay / 100); // TODO USE CURRENT CONVERSION RATES
        $property = $booking->property;

        return [
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.return-url'), // The URL where the customer is redirected after the customer approves the payment.
                'cancel_url' => route('paypal.cancel-url'), // The URL where the customer is redirected after the customer cancels the payment.
                'brand_name' => config('app.name'),
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                0 => [
                    'reference_id' => $booking->uuid,
                    'description' => $property->name,
                    'custom_id' => $property->id,
                    'soft_descriptor' => $property->id,
                    'amount' =>
                        [
                            'currency_code' => 'USD',
                            'value' => $amountToPay,
                            'breakdown' => [
                                'item_total' => [
                                    'currency_code' => 'USD',
                                    'value' => $amountToPay,
                                ]
                            ]
                        ],
                    'items' =>
                        [
                            0 =>
                                [
                                    'name' => $property->name,
                                    'description' => sprintf('Payment for %s nights', $booking->number_of_nights),
                                    'sku' => $property->id,
                                    'unit_amount' =>
                                        [
                                            'currency_code' => 'USD',
                                            'value' => $amountToPay,
                                        ],
                                    'quantity' => '1',
                                    'category' => 'PHYSICAL_GOODS'
                                ]
                        ],
                ],
            ],
        ];
    }

    /**
     * Process the paypal callback
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function returnURL(Request $request): RedirectResponse
    {
        $orderID = $request['token'];

        $payment = Payment::wherePaypalOrderId($orderID)
            ->with('booking:id,uuid')
            ->first([
                'id', 'booking_id'
            ]);

        if (!$payment) {
            return redirect()->route('index');
        }

        try {
            $client = self::client();

            $captureRequest = new OrdersCaptureRequest($orderID);

            $response = $client->execute($captureRequest);
        } catch (Exception) {
            return redirect()->route('index');
        }

        /** @noinspection PhpUndefinedFieldInspection */
        $status = $response->result->status;

        $isCompletedSuccessfully = $status === 'COMPLETED';

        try {
            DB::table('payments')->where('paypal_order_id', $orderID)
                ->update([
                    'callback_data' => json_encode($response, JSON_THROW_ON_ERROR),
                    'is_successful' => $isCompletedSuccessfully,
                    'is_paid' => $isCompletedSuccessfully,
                    'updated_at' => now()
                ]);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        return redirect()->route('booking.show', $payment->booking->uuid);
    }

    /**
     * Handle the cancellation url for paypal.
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function cancelURL(Request $request): RedirectResponse
    {
        try {
            Payment::where('paypal_order_id', $request['token'])
                ->update([
                    'is_cancelled' => true
                ]);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        return redirect()->route('booking.index');
    }
}
