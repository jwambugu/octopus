<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MpesaController extends Controller
{
    /**
     * Process the callback data sent by mpesa
     * @param Request $request
     * @return JsonResponse
     */
    public function lipaNaMpesaCallback(Request $request)
    {
        $response = json_decode($request->getContent());

        info('mpesa-response', [$response]);

//        $callbackData = $response->Body->stkCallback;
//        $merchantRequestID = $callbackData->MerchantRequestID;
//        $checkoutRequestID = $callbackData->CheckoutRequestID;
//        $resultCode = $callbackData->ResultCode;
//
//        // Validate the transaction
//        $payment = $this->validateTransaction($merchantRequestID, $checkoutRequestID);
//
//        if (!$payment) {
//            return $this->rejectTransaction();
//        }
//
//        // Check if the transaction was successful. All successful transactions have a result code of 0
//        if ($resultCode != 0) {
//            // Mark the transaction as failed
//            try {
//                $this->updateTransactionData($payment, [
//                    'is_paid' => false,
//                    'callback_data' => $response,
//                    'transaction_id' => null,
//                    'paid_amount' => 0
//                ]);
//            } catch (Exception $e) {
//                return $this->rejectTransaction();
//            }
//
//            return $this->acceptTransaction();
//        }
//
//        // Extract the request metadata
//        $callbackMetadata = $callbackData->CallbackMetadata;
//        $transactionID = $callbackMetadata->Item[1]->Value;
//        $amount = $callbackMetadata->Item[0]->Value;
//
//        // Check if we have a similar transaction id
//        if ($this->transactionIDExists($transactionID)) {
//            return $this->rejectTransaction();
//        }
//
//        try {
//            // Mark the transaction as successful
//            $this->updateTransactionData($payment, [
//                'is_paid' => true,
//                'callback_data' => $response,
//                'transaction_id' => $transactionID,
//                'paid_amount' => $amount
//            ]);
//        } catch (Exception $e) {
//            return $this->rejectTransaction();
//        }
//
//        return $this->acceptTransaction();
    }
}
