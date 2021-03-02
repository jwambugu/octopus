<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Property;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;


class PaymentController extends Controller
{
    /**
     * Crates a random alphanumeric string to be used as an account number
     * @return false|string
     */
    private function generateAccountNumber()
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 6)), 0, 6);
    }

    /**
     * Creates a new booking payment record.
     * @param int $propertyID
     * @param int $bookingID
     * @param int $userID
     * @return Payment|Model
     * @throws Exception
     */
    public static function createBookingPayment(int $propertyID, int $bookingID, int $userID)
    {
        // Get a new account number
        $accountNumber = (new PaymentController)->generateAccountNumber();

        // Get the property data
        $property = Property::find($propertyID, [
            'id', 'cost_per_night'
        ]);

        // Generate a new uuid
        $uuid = Uuid::uuid4();

        try {
            return Payment::create([
                'uuid' => $uuid,
                'account_number' => $accountNumber,
                'amount' => $property->cost_per_night,
                'booking_id' => $bookingID,
                'property_id' => $property->id,
                'user_id' => $userID,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Generates a new access token from mpesa. THe token is used to authenticate all the API calls.
     * @return mixed
     */
    private function generateAccessToken()
    {
        // Build the URL for the auth endpoint
        $url = sprintf(
            '%soauth/v1/generate?grant_type=client_credentials', config('services.mpesa.base_url')
        );

        $response = Http::withBasicAuth(
            config('services.mpesa.consumer_key'), config('services.mpesa.consumer_secret')
        )->get($url)->json();

        // Extract the access token from the response data
        return $response['access_token'];
    }

    /**
     * Caches the access token from 55 minutes so as to speed up the requests
     * @return mixed
     */
    private function cachedAccessToken()
    {
        // Create a cache key
        $key = "MPESA_ACCESS_TOKEN";

        if (!Cache::has($key)) {
            Cache::remember($key, now()->addMinutes(55), function () {
                return $this->generateAccessToken();
            });
        }

        return Cache::get($key);
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
        // Format the phone number to Intl format
        $phoneNumber = sprintf('254%s', substr($phoneNumber, 1, 9));

        // Generate an access token
        $accessToken = (new PaymentController())->cachedAccessToken();

        // Build the URL for the lnmo endpoint
        $url = sprintf('%smpesa/stkpush/v1/processrequest', config('services.mpesa.base_url'));

        // Read the config data
        $shortcode = config('services.mpesa.short_code');

        // Get the current timestamp YmdHis
        $timestamp = now()->format('YmdHis');

        // The password for encrypting the request.
        //This is generated by base64 encoding BusinessShortcode, Passkey and Timestamp.
        $password = base64_encode(
            sprintf('%s%s%s', $shortcode, config('services.mpesa.passkey'), $timestamp)
        );

        // Make the request
        $response = Http::withToken($accessToken)->post($url, [
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
//            'Amount' => $payment->amount,
            'Amount' => 1,
            'PartyA' => $phoneNumber,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => route('lnm-callback'),
            'AccountReference' => $payment->account_number,
            'TransactionDesc' => 'Payment through STK push.'
        ])->json();

        // Keep track of the request status
        $isSuccessful = true;

        // Check if the request was successful
        if (!isset($response['ResponseCode'])) {
            return false;
        }

        if ($response['ResponseCode'] != "0") {
            $isSuccessful = false;
        }

        try {
            // Process payment
            $data = compact('response', 'phoneNumber', 'payment', 'isSuccessful');

            (new PaymentController)->updateOrCreateBookingPayment($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $isSuccessful;
    }

    /**
     * Handles the update or creation of order payments
     * @param array $data
     * @throws Exception
     */
    private function updateOrCreateBookingPayment(array $data)
    {
        // Extract the data
        $response = $data['response'];
        $payment = $data['payment'];
        $isSuccessful = $data['isSuccessful'];
        $phoneNumber = $data['phoneNumber'];

        $merchantRequestID = $response['MerchantRequestID'];
        $checkoutRequestID = $response['CheckoutRequestID'];

        // Find the payment using the payment using the payment id
        $payment = Payment::query()->find($payment->id);

        // Check if we have a merchant_request_id. If it's null, then the payment was not processed
        // We will update it and exit
        if (is_null($payment->merchant_request_id)) {
            try {
                Payment::query()->where('id', $payment->id)->update([
                    'merchant_request_id' => $merchantRequestID,
                    'checkout_request_id' => $checkoutRequestID,
                    'phone_number' => $phoneNumber,
                    'request_response_data' => json_encode($response),
                    'is_successful' => $isSuccessful
                ]);
            } catch (Exception $exception) {
                throw new Exception($exception->getMessage());
            }

            return;
        }

        // If we get here, it means the payment had been processed early.
        // We will create a new payment instead with the same account number
        try {
            $this->createBookingPayment($payment->property_id, $payment->booking_id, $payment->user_id);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}