<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;
use RuntimeException;


class PaymentController extends Controller
{
    /**
     * Crates a random alphanumeric string to be used as an account number
     * @return string
     */
    public function generateAccountNumber(): string
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 6)), 0, 6);
    }

    /**
     * Creates a new booking payment record.
     * @param int $numberOfNights
     * @param object $property
     * @param int $bookingID
     * @param int $userID
     * @return Model|Payment
     */
    public static function createBookingPayment(int $numberOfNights, object $property, int $bookingID, int $userID): Model|Payment
    {
        $accountNumber = (new self)->generateAccountNumber();
        $uuid = Uuid::uuid4();

        $amount = $property->cost_per_night * $numberOfNights;

        // TODO: split the payments if value is greater than 70,000

        try {
            return Payment::query()
                ->create([
                    'uuid' => $uuid,
                    'account_number' => $accountNumber,
                    'amount' => $amount,
                    'booking_id' => $bookingID,
                    'property_id' => $property->id,
                    'user_id' => $userID,
                ]);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    /**
     * Generates a new access token from mpesa.
     * @return string
     * @throws Exception
     */
    private function generateAccessToken(): string
    {
        $base = config('services.mpesa.base_url');
        $url = sprintf('%soauth/v1/generate?grant_type=client_credentials', $base);

        $response = Http::withBasicAuth(
            config('services.mpesa.consumer_key'), config('services.mpesa.consumer_secret')
        )->get($url);

        if (!$response->successful()) {
            throw new RuntimeException(sprintf('Could not generate access token : %s', $response->reason()));
        }

        $data = $response->json();
        return (string)$data['access_token'];
    }

    /**
     * Caches the access token from 55 minutes so as to speed up the requests
     * @return mixed
     */
    private function cachedAccessToken(): mixed
    {
        return Cache::remember('MPESA_ACCESS_TOKEN', now()->addMinutes(55), function () {
            return $this->generateAccessToken();
        });
    }

    /**
     * Makes a request to Mpesa and generates a lipa na mpesa request to be used to make the payment
     * @param string $phoneNumber
     * @param object $payment
     * @return bool
     * @throws Exception
     */
    public static function lipaNaMpesaOnline(string $phoneNumber, object $payment): bool
    {
        $phoneNumber = sprintf('254%s', substr($phoneNumber, 1, 9));

        $accessToken = (new self)->cachedAccessToken();
        $url = sprintf('%smpesa/stkpush/v1/processrequest', config('services.mpesa.base_url'));

        $shortcode = config('services.mpesa.short_code');
        $timestamp = now()->format('YmdHis');
        $password = base64_encode(
            sprintf('%s%s%s', $shortcode, config('services.mpesa.passkey'), $timestamp)
        );


        $response = Http::withToken($accessToken)->post($url, [
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $payment->amount,
            'PartyA' => $phoneNumber,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => route('lnm-callback'),
            'AccountReference' => $payment->account_number,
            'TransactionDesc' => 'Payment through STK push.'
        ]);

        info($response->reason());

        $response = $response->json();

        if (!isset($response['ResponseCode'])) {
            return false;
        }

        $isSuccessful = true;

        /** @noinspection TypeUnsafeComparisonInspection */
        if ($response['ResponseCode'] != "0") {
            $isSuccessful = false;
        }

        try {
            $data = compact('response', 'phoneNumber', 'payment', 'isSuccessful');

            (new self)->updateOrCreateBookingPayment($data);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        return $isSuccessful;
    }

    /**
     * Handles the update or creation of order payments
     * @param array $data
     * @throws Exception
     */
    private function updateOrCreateBookingPayment(array $data): void
    {
        $response = $data['response'];
        $payment = $data['payment'];
        $isSuccessful = $data['isSuccessful'];
        $phoneNumber = $data['phoneNumber'];

        $merchantRequestID = $response['MerchantRequestID'];
        $checkoutRequestID = $response['CheckoutRequestID'];

        $payment = Payment::query()->find($payment->id);

        if (is_null($payment->merchant_request_id)) {
            try {
                Payment::query()
                    ->where('id', $payment->id)
                    ->update([
                        'merchant_request_id' => $merchantRequestID,
                        'checkout_request_id' => $checkoutRequestID,
                        'phone_number' => $phoneNumber,
                        'request_response_data' => json_encode($response, JSON_THROW_ON_ERROR),
                        'is_successful' => $isSuccessful,
                        'payment_channel_id' => Payment::ModeMpesa
                    ]);
            } catch (Exception $exception) {
                throw new RuntimeException($exception->getMessage());
            }

            return;
        }

        // If we get here, it means the payment had been processed earlier.
        // We will create a new payment instead with the same account number
        try {
            self::createBookingPayment(
                $payment->booking->number_of_nights, $payment->property, $payment->booking_id, $payment->user_id
            );
        } catch (Exception $exception) {
            throw new RuntimeException($exception->getMessage());
        }
    }
}
