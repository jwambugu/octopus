<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPropertyRequest;
use App\Http\Requests\MpesaPaymentRequest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Rating;
use App\Models\Refund;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;
use Throwable;
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
     * Render the view for showing the properties booked by the user.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Get the auth user data
        $user = $request->user();

        // Get the user bookings
        $bookings = Booking::whereUserId($user->id)->with('property')
            ->orderByDesc('created_at')
            ->paginate(10);

        $links = (string)$bookings->links();

        return \view('bookings.index')->with([
            'bookings' => $bookings,
            'links' => $links,
        ]);
    }

    /**
     * Determine if a user can cancel a booking.
     * @param Booking $booking
     * @return bool
     */
    private function canCancelBooking(Booking $booking): bool
    {
        // If the booking had been cancelled, block them from asking for a refund
        if (!is_null($booking->cancelled_at)) {
            return false;
        }

        // Check if the user is supposed to checkin in today.
        // if they are, block them from cancelling
        $timeElapsedSinceBooking = now()->diffInDays($booking->checkin_date, false);

        if ($timeElapsedSinceBooking <= 0) {
            return false;
        }

        $cancellationTimeFrame = $booking->property->cancellationPolicy->timeframe_in_hours;

        if ($cancellationTimeFrame == 0) {
            return true;
        }

        $timeFrame = now()->subHours($cancellationTimeFrame);

        // Check if the user can cancel the booking
        $diffInHours = Carbon::parse($timeFrame)->diffInHours($booking->created_at);

        return $diffInHours != 0;
    }

    /**
     * Render the view showing booking details
     * @param Booking $booking
     * @return Application|Factory|View
     */
    public function show(Booking $booking)
    {
        // Get the booking data
        $booking = $booking->load([
            'property',
            'property.owner:id,name,email,phone_number,description',
            'property.owner.profilePicture:id,admin_id,public_url',
            'property.cancellationPolicy:id,title,description,timeframe_in_hours,percentage_to_refund',
            'property.amenities',
            'payments:id,account_number,amount,is_paid,booking_id,created_at'
        ]);

        $canCancel = $this->canCancelBooking($booking);

        return \view('bookings.show')->with([
            'booking' => $booking,
            'canCancel' => $canCancel
        ]);
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
     * Create a new property booking rating
     * @param Booking $booking
     * @return void
     * @throws Exception
     */
    private function createBookingRating(Booking $booking): void
    {
        // Get the data for the property being booked
        $booking = $booking->load('property:id,admin_id');

        // Generate a new uuid
        $uuid = Uuid::uuid4();

        try {
            Rating::create([
                'uuid' => $uuid,
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'admin_id' => $booking->property->admin_id,
            ]);
            return;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
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
        $checkinDate = $request['checkin_date'];
        $checkoutDate = $request['checkout_date'];

        $numberOfNights = Carbon::parse($checkoutDate)->diffInDays($checkinDate);
        $numberOfNights = $numberOfNights == 0 ? 1 : $numberOfNights;

        // Generate a new uuid
        $uuid = Uuid::uuid4();

        try {
            $booking = Booking::create([
                'uuid' => $uuid,
                'checkin_date' => $checkinDate,
                'checkout_date' => $checkoutDate,
                'number_of_nights' => $numberOfNights,
                'property_id' => $propertyID,
                'user_id' => auth()->id(),
            ]);

            // Add payment
            PaymentController::createBookingPayment($numberOfNights, $propertyID, $booking->id, $user->id);

            // Create the booking rating data
            $this->createBookingRating($booking);
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
        $payment = Payment::query()->with('booking')->find($paymentID, [
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

    /**
     * Processes the request for confirming a payment confirming request.
     * @param Booking $booking
     * @return JsonResponse
     */
    public function confirmBookingPayment(Booking $booking): JsonResponse
    {
        // Get the booking payment that was recently created and was successful
        $payment = Payment::with('booking')->where([
            'booking_id' => $booking->id,
            'is_successful' => true
        ])->latest()->first();

        if (is_null($payment->callback_data)) {
            return response()->json([
                'data' => [
                    'message' => 'Waiting for payment confirmation. Please wait..',
                    'alertClass' => 'alert-info',
                    'next' => route('booking.index'),
                    'status' => 'waiting',
                ]
            ]);
        }

        if (!$payment->is_paid) {
            return response()->json([
                'data' => [
                    'message' => 'Payment was unsuccessful. Please try again.',
                    'alertClass' => 'alert-danger',
                    'next' => route('booking.index'),
                    'status' => 'failed',
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => 'Payment processed successful.',
                'alertClass' => 'alert-success',
                'next' => route('booking.show', [
                    'booking' => $payment->booking->uuid
                ]),
                'status' => 'success',
            ]
        ]);
    }

    /**
     * Process the request for cancelling a booking
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function cancelBooking(Request $request): JsonResponse
    {
        $booking = Booking::query()->with('property:id,admin_id', 'property.owner:id')
            ->whereUuid($request['uuid'])
            ->first([
                'id', 'property_id', 'cancelled_at'
            ]);

        if (!$booking || !is_null($booking->cancelled_at)) {
            throw ValidationException::withMessages([
                'booking' => 'Invalid booking provided or payment already refund.'
            ]);
        }

        // Get the amount to refund from the payments.
        // Only get the successful transactions
        $payment = DB::table('payments')->where([
            'is_successful' => true,
            'booking_id' => $booking->id
        ])->first('amount');

        if (!$payment) {
            throw ValidationException::withMessages([
                'booking' => 'Invalid booking provided or payment already refund.'
            ]);
        }

        $amount = $payment->amount;

        try {
            DB::transaction(function () use ($booking, $amount) {
                // Set the booking as cancelled
                Booking::whereId($booking->id)->update([
                    'cancelled_at' => now()
                ]);

                // Create a new refund
                Refund::create([
                    'amount' => $amount,
                    'booking_id' => $booking->id,
                    'payment_channel_id' => 1,
                    'user_id' => auth()->id(),
                    'admin_id' => $booking->property->owner->id
                ]);
            });
        } catch (Throwable $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Request processed successful. You will be refunded within 24 hours.'
            ]
        ]);
    }
}
