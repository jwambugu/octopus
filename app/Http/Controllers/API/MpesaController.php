<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\PropertyBooked;
use App\Models\Booking;
use App\Models\Payment;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * Marks a transaction as either completed or failed depending on the response sent
     * @param object $payment
     * @param array $transactionData
     * @throws Exception
     */
    private function updateTransactionData(object $payment, array $transactionData)
    {
        try {
            Payment::where('id', $payment->id)->update([
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

                Mail::to($booking->user->email)->queue(new PropertyBooked($booking));
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
