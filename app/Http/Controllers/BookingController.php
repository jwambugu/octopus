<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPropertyRequest;
use App\Http\Requests\MpesaPaymentRequest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Property;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;
use URL;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Render the view for showing the property booking
     * @param Property $property
     * @return Application|Factory|View
     */
    public function showPropertyBookingView(Property $property)
    {
        // Get the property amenities
        $property = $property->load('amenities');

        return view('bookings.property-book')->with([
            'property' => $property
        ]);
    }

    /**
     * Process the request for booking a property
     * @param BookPropertyRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function bookProperty(BookPropertyRequest $request): JsonResponse
    {
        // Get the request data
        $propertyID = $request['property_id'];
        $user = $request->user();

        // Generate a new uuid
        $uuid = Uuid::uuid4();

        try {
            $booking = Booking::create([
                'uuid' => $uuid,
                'checkin_date' => $request['checkin_date'],
                'checkout_date' => $request['checkout_date'],
                'property_id' => $propertyID,
                'user_id' => auth()->id(),
            ]);

            // Add payment
            PaymentController::createBookingPayment($propertyID, $booking->id, $user->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Property booked successfully.',
                'next' => URL::signedRoute('booking.book.lipa-na-mpesa', [
                    'booking' => $booking->uuid,
                ])
            ]
        ]);
    }

    /**
     * Renders the view for making mpesa payments
     * @param Request $request
     * @param Booking $booking
     * @return Application|Factory|View
     */
    public function renderMpesaPaymentView(Request $request, Booking $booking)
    {
        // Get the request data
        $user = $request->user();

        // Find the payment using the uuid
        $booking = $booking->load('unsuccessfulPayments', 'property');

        if (!$booking) {
            abort(404);
        }
        return \view('bookings.payments.mpesa')->with([
            'booking' => $booking,
            'user' => $user,
        ]);
    }

    /**
     * Process the request for making a payment using mpesa.
     * @param MpesaPaymentRequest $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function processMpesaPaymentRequest(MpesaPaymentRequest $request): JsonResponse
    {
        // Get the request data
        $paymentID = $request['payment_id'];
        $phoneNumber = $request['phone_number'];

        // Find the payment using the id
        $payment = Payment::find($paymentID, [
            'id', 'account_number', 'amount', 'booking_id', 'property_id', 'user_id',
        ]);

        if (!$payment) {
            throw ValidationException::withMessages([
                'payment' => 'Invalid payment. Please try again.'
            ]);
        }

        try {
            // Initiate an STK push request
            $isSuccessful = PaymentController::lipaNaMpesaOnline($phoneNumber, $payment);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $message = $isSuccessful ?
            'Payment request pushed successfully.' :
            'Sorry. Something went wrong. Please try again.';

        return response()->json([
            'data' => [
                'isSuccessful' => $isSuccessful,
                'message' => $message,
            ]
        ]);
    }

    public function confirmBookingPayment(Booking $booking)
    {
        $payment = Payment::where([
            'booking_id' => $booking->id,
            'is_successful' => true
        ])->latest()->first();

        if (is_null($payment->callback_data)) {
            return response()->json([
                'data' => [
                    'message' => 'Waiting for payment confirmation. Please wait..',
                    'alertClass' => 'alert-info'
                ]
            ]);
        }

        if (!$payment->is_paid) {
            return response()->json([
                'data' => [
                    'message' => 'Payment was unsuccessful. Please try again.',
                    'alertClass' => 'alert-danger'
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => 'Payment processed successful.',
                'alertClass' => 'alert-success'
            ]
        ]);
    }
}
