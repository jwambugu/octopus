<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use DB;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;


class PayPalController extends Controller
{
    /**
     * Returns the environment to use when making the payment.
     *
     * @return ProductionEnvironment|SandboxEnvironment
     */
    private static function environment()
    {
        $environment = config('paypal.current_environment');

        $config = config('paypal.environment');

        return $environment != 'sandbox' ?
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

    public static function createOrderRequest(): array
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = self::buildRequestBody();

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
     * @return array
     */
    private static function buildRequestBody(): array
    {

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
                    'reference_id' => 'PUHF',
                    'description' => 'Sporting Goods',
                    'custom_id' => 'CUST-HighFashions',
                    'soft_descriptor' => 'HighFashions',
                    'amount' =>
                        [
                            'currency_code' => 'USD',
                            'value' => '1.00',
                            'breakdown' => [
                                'item_total' => [
                                    'currency_code' => 'USD',
                                    'value' => '1.00',
                                ]
                            ]
                        ],
                    'items' =>
                        [
                            0 =>
                                [
                                    'name' => 'T-Shirt',
                                    'description' => 'Green XL',
                                    'sku' => 'sku01',
                                    'unit_amount' =>
                                        [
                                            'currency_code' => 'USD',
                                            'value' => '1.00',
                                        ],
                                    'quantity' => '1',
                                    'category' => 'PHYSICAL_GOODS'
                                ]
                        ],
                ],
            ],
        ];
    }

    public function returnURL(Request $request)
    {
        // 9CE84966M09339251
        try {
            // 9CE84966M09339251
            $client = self::client();

            $orderID = $request['token'];

            $captureRequest = new OrdersCaptureRequest($orderID);

            $response = $client->execute($captureRequest);
        } catch (Exception $e) {
            return redirect()->route('index');
        }

        info('returnURLPayload', [$response]);

        $status = $response->result->status;

        $isCompletedSuccessfully = $status == 'COMPLETED';

        DB::table('payments')->where('paypal_order_id', $orderID)->update([
            'callback_data' => json_encode($response),
            'is_successful' => $isCompletedSuccessfully,
            'is_paid' => $isCompletedSuccessfully,
            'updated_at' => now()
        ]);
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
            $payment = Payment::where('paypal_order_id', $request['token']);

            if ($payment) {
                $payment->update([
                    'is_cancelled' => true
                ]);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('booking.index');
    }
}
