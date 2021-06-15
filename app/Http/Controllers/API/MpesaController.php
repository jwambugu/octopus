<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SMSController;
use App\Mail\PropertyBooked;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\SMSOutbox;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Mail;

class MpesaController extends Controller
{
    /**
     * We will check if a transaction exists using the merchantRequestID and checkoutRequestID returned.
     * We also get the transaction that has not been paid due to receiving duplicated callbacks
     * @param string $merchantRequestID
     * @param string $checkoutRequestID
     * @return Builder|Model|object|null
     */
    private function validateTransaction(string $merchantRequestID, string $checkoutRequestID)
    {
        return Payment::where([
            ['merchant_request_id', '=', $merchantRequestID],
            ['checkout_request_id', '=', $checkoutRequestID],
            ['is_paid', '=', false],
        ])->first([
            'id', 'booking_id'
        ]);
    }

    /**
     * Generic response sent when we don't want to proceed with the request.
     * @return JsonResponse
     */
    private function rejectTransaction(): JsonResponse
    {
        return response()->json([
            "ResultCode" => 1,
            "ResultDesc" => "Rejected",
        ], Response::HTTP_FORBIDDEN)->header('Content-Type', 'application/json');
    }

    /**
     * Generic response sent to acknowledge we processed the transaction successfully
     * @return JsonResponse
     */
    private function acceptTransaction(): JsonResponse
    {
        return response()->json([
            "ResultCode" => 0,
            "ResultDesc" => "Success",
        ], Response::HTTP_OK)->header('Content-Type', 'application/json');
    }

    /**
     * Checks if we have any similar transaction ids in the system
     * @param string $transactionID
     * @return bool
     */
    private function transactionIDExists(string $transactionID): bool
    {
        // Get the count of transaction ids which match the passed one
        $transactionIDs = Payment::whereIn('transaction_id', [$transactionID])->count(['id']);

        return $transactionIDs != 0;
    }

    /**
     * Add an sms to the guest
     * @param object $user
     * @param string $transactionID
     * @return SMSOutbox|Model|null
     * @throws Exception
     */
    private function createGuestSMS(object $user, string $transactionID)
    {
        $firstName = explode(' ', $user->name)[0];

        // Create an SMS to send to the guest
        $message = sprintf(
            "Hello %s, we have received your payment %s. Thanks for choosing to stay with us.",
            $firstName, $transactionID
        );

        $phoneNumber = $user->phone_number;

        $isKenyanPhoneNumber = Str::startsWith($phoneNumber, '07') || Str::startsWith($phoneNumber, '01');

        if (!$isKenyanPhoneNumber) {
            return null;
        }

        $phoneNumber = sprintf("+254%s", substr($phoneNumber, 1, 10));

        try {
            return (new SMSController)->create($phoneNumber, $message);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Add an sms to the host
     * @param object $host
     * @param string $guestName
     * @param string $propertyName
     * @return SMSOutbox|Model
     * @throws Exception
     */
    private function createHostSMS(object $host, string $guestName, string $propertyName)
    {
        $hostFirstName = explode(' ', $host->name)[0];
        $guestFirstName = explode(' ', $guestName)[0];

        // Create an SMS to send to the guest
        $message = sprintf(
            "Hello %s, property %s has been successfully booked by %s. Thanks for partnering with us.",
            $hostFirstName, $propertyName, $guestFirstName
        );

        try {
            return (new SMSController)->create($host->phone_number, $message);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Returns the payment data for the id passed
     * @param int $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    private function findPayment(int $id)
    {
        return Payment::with([
            'property',
            'property.owner:id,name,email,phone_number',
            'user:id,name,phone_number'
        ])->find($id, [
            'id', 'transaction_id', 'property_id', 'user_id'
        ]);
    }

    /**
     * Create the sms to send to the host and the guest
     * @param object $payment
     * @throws Exception
     */
    private function sendSMSes(object $payment)
    {
        // Get the payment details
        $guest = $payment->user;
        $host = $payment->property->owner;
        $property = $payment->property;

        try {
            // Create an SMS to send to the host
            $this->createHostSMS($host, $guest->name, $property->name);

            // Create an SMS to send to the guest
            $this->createGuestSMS($guest, $payment->transaction_id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    /**
     * Marks a transaction as either completed or failed depending on the response sent
     * @param object $payment
     * @param array $transactionData
     * @throws Exception
     */
    private function updateTransactionData(object $payment, array $transactionData)
    {
        $paymentID = $payment->id;

        try {
            Payment::where('id', $paymentID)->update([
                'paid_amount' => $transactionData['paid_amount'],
                'is_paid' => $transactionData['is_paid'],
                'is_successful' => $transactionData['is_paid'],
                'callback_data' => json_encode($transactionData['callback_data']),
                'transaction_id' => $transactionData['transaction_id'],
            ]);

            // if the transaction was successful, update the booking payment. Set is_paid to true
            if ($transactionData['is_paid']) {
                Booking::where('id', $payment->booking_id)->update([
                    'is_paid' => true,
                ]);

                // Send an email to the user
                $booking = Booking::with('property', 'property.owner', 'user', 'property.city')
                    ->find($payment->booking_id);

                // Get the guest details
                $guest = $booking->user;

                // Send an email to the guest
                Mail::to($guest->email)->queue(new PropertyBooked($booking));

                // Get the payment data
                $paymentData = $this->findPayment($paymentID);

                // Create the sms
                $this->sendSMSes($paymentData);
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Process the callback data sent by mpesa
     * @param Request $request
     * @return JsonResponse
     */
    public function lipaNaMpesaCallback(Request $request): JsonResponse
    {
        $response = json_decode($request->getContent());


        $callbackData = $response->Body->stkCallback;
        $merchantRequestID = $callbackData->MerchantRequestID;
        $checkoutRequestID = $callbackData->CheckoutRequestID;
        $resultCode = $callbackData->ResultCode;

        // Validate the transaction
        $payment = $this->validateTransaction($merchantRequestID, $checkoutRequestID);

        if (!$payment) {
            return $this->rejectTransaction();
        }

        // Check if the transaction was successful. All successful transactions have a result code of 0
        if ($resultCode != 0) {
            // Mark the transaction as failed
            try {
                $this->updateTransactionData($payment, [
                    'is_paid' => false,
                    'callback_data' => $response,
                    'transaction_id' => null,
                    'paid_amount' => 0
                ]);
            } catch (Exception $e) {
                return $this->rejectTransaction();
            }

            return $this->acceptTransaction();
        }

        // Extract the request metadata
        $callbackMetadata = $callbackData->CallbackMetadata;
        $transactionID = $callbackMetadata->Item[1]->Value;
        $amount = $callbackMetadata->Item[0]->Value;

        // Check if we have a similar transaction id
        if ($this->transactionIDExists($transactionID)) {
            return $this->rejectTransaction();
        }

        try {
            // Mark the transaction as successful
            $this->updateTransactionData($payment, [
                'is_paid' => true,
                'callback_data' => $response,
                'transaction_id' => $transactionID,
                'paid_amount' => $amount
            ]);
        } catch (Exception $e) {
            return $this->rejectTransaction();
        }

        return $this->acceptTransaction();
    }
}
