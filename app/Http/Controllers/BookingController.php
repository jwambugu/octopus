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
use RuntimeException;
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
    public function index(Request $request): View|Factory|Application
    {
        $user = $request->user();

        // Get the user bookings
        $bookings = Booking::whereUserId($user->id)
            ->where('is_closing_booking', false)
            ->with('property')
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

        if ($cancellationTimeFrame === 0) {
            return true;
        }

        $timeFrame = now()->subHours($cancellationTimeFrame);
        $diffInHours = Carbon::parse($timeFrame)->diffInHours($booking->created_at);

        return $diffInHours !== 0;
    }

    /**
     * Render the view showing booking details
     * @param Booking $booking
     * @return Application|Factory|View
     */
    public function show(Booking $booking): View|Factory|Application
    {
        $timeElapsedSinceBooking = now()->diffInDays($booking->checkout_date, false);
        $canShowHostDetails = $timeElapsedSinceBooking > 0;

        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $booking = $booking->load([
            'property',
            'property.owner:id,name,email,phone_number,description',
            'property.owner.profilePicture:id,admin_id,public_url',
            'property.cancellationPolicy:id,title,description,timeframe_in_hours,percentage_to_refund',
            'property.amenities',
            'payments:id,account_number,amount,is_paid,booking_id,created_at'
        ]);

        /** @noinspection PhpUndefinedFieldInspection */
        $booking->canShowHostDetails = $canShowHostDetails;

        $canCancel = $this->canCancelBooking($booking);
        $cancellationChargesBreakdown = $this->getCancellationChargesBreakdown($booking);

        return view('bookings.show')->with([
            'booking' => $booking,
            'canCancel' => $canCancel,
            'cancellationChargesBreakdown' => $cancellationChargesBreakdown
        ]);
    }

    /**
     * Render the view for showing the property booking
     * @param Property $property
     * @return Application|Factory|View
     */
    public function showPropertyBookingView(Property $property): View|Factory|Application
    {
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $property = $property->load('amenities', 'activeBookingsDates');

        $bookedDates = self::getPropertyBookedDates($property);

        return view('bookings.property-book')->with([
            'property' => $property,
            'bookedDates' => $bookedDates
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
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $booking = $booking->load('property:id,admin_id');

        try {
            Rating::create([
                'uuid' => Uuid::uuid4(),
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'admin_id' => $booking->property->admin_id,
            ]);
            return;
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
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
        $checkinDate = Carbon::parse($request['checkin_date']);
        $checkoutDate = Carbon::parse($request['checkout_date']);
        $propertyID = $request['property_id'];

        $numberOfNights = $checkinDate->diffInDays($checkoutDate, false);

        if ($numberOfNights <= 0) {
            throw ValidationException::withMessages([
                'checkin_date' => "Checkout date must be greater than or equal to checkin date."
            ]);
        }

        $bookingsBetween = Booking::query()
            ->where([
                'property_id' => $propertyID,
                'is_paid' => true,
            ])
            ->whereBetween('checkin_date', [$checkinDate, $checkoutDate])
            ->first(['id']);


        if ($bookingsBetween) {
            throw ValidationException::withMessages([
                'checkin_date' => 'Property is already booked within the specified date range.'
            ]);
        }

        try {
            $booking = DB::transaction(function () use ($numberOfNights, $checkinDate, $checkoutDate, $propertyID) {
                $userID = auth()->id();

                $property = Property::query()
                    ->with('cancellationPolicy')
                    ->find($propertyID, [
                        'id', 'cost_per_night', 'cancellation_policy_id', 'admin_id'
                    ]);

                $numberOfNights = $numberOfNights === 0 ? 1 : $numberOfNights;

                $booking = Booking::create([
                    'uuid' => Uuid::uuid4(),
                    'checkin_date' => $checkinDate,
                    'checkout_date' => $checkoutDate,
                    'number_of_nights' => $numberOfNights,
                    'cost_per_night' => $property->cost_per_night,
                    'cancellation_policy_data' => $property->cancellationPolicy,
                    'property_id' => $propertyID,
                    'user_id' => $userID,
                    'admin_id' => $property->admin_id,
                ]);

                PaymentController::createBookingPayment($numberOfNights, $property, $booking->id, $userID);
                $this->createBookingRating($booking);

                return $booking;
            });
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage());
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
    public function renderMpesaPaymentView(Request $request, Booking $booking): View|Factory|Application
    {
        $user = $request->user();
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $booking = $booking->load('unsuccessfulPayments', 'property');

        if (!$booking) {
            abort(404);
        }
        return view('bookings.payments.mpesa')->with([
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

        $paymentID = $request['payment_id'];
        $phoneNumber = $request['phone_number'];

        $payment = Payment::query()
            ->with('booking')
            ->find($paymentID, [
                'id', 'account_number', 'amount', 'booking_id', 'property_id', 'user_id',
            ]);

        if (!$payment) {
            throw ValidationException::withMessages([
                'payment' => 'Invalid payment. Please try again.'
            ]);
        }

        try {
            $isSuccessful = PaymentController::lipaNaMpesaOnline($phoneNumber, $payment);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
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
        $payment = Payment::query()
            ->with('booking')
            ->where([
                'booking_id' => $booking->id,
                'is_successful' => true
            ])->latest()->first();


        if (!$payment || is_null($payment->callback_data)) {
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
     * Returns a summary of the charges to be accrued if the user cancels.
     * @param object $booking
     * @return array
     */
    private function getCancellationChargesBreakdown(object $booking): array
    {
        $cancellationPolicy = (object)$booking->cancellation_policy_data;
        $commissionPercentage = $cancellationPolicy->percentage_to_refund / 100;

        $payment = Payment::query()
            ->where([
                'is_paid' => true,
                'booking_id' => $booking->id,
            ])
            ->first('amount');

        if (!$payment) {
            return [];
        }

        $bookingAmount = $payment->amount;
        $commission = (int)floor($commissionPercentage * $bookingAmount);

        $transactionCharges = DB::table('transaction_charges')
            ->whereRaw('? BETWEEN minimum_amount AND maximum_amount', [$bookingAmount])
            ->first([
                'charges'
            ]);

        if (!$transactionCharges) {
            return [];
        }

        $charges = ceil($transactionCharges->charges);
        $refundableAmount = (int)floor($bookingAmount - ($commission + $charges));

        // For non refundable payments the time frame will be 0, meaning the guest will not be refunded
        $refundableAmount = (int)$cancellationPolicy->timeframe_in_hours !== 0 ? $refundableAmount : 0;

        return [
            'bookingAmount' => (int)$bookingAmount,
            'commission' => $commission,
            'transactionCharges' => $charges,
            'refundableAmount' => $refundableAmount,
            'isRefundable' => $refundableAmount !== 0
        ];
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
        $booking = Booking::query()
            ->select(['id', 'property_id', 'cancelled_at', 'cancellation_policy_data', 'is_paid'])
            ->with('property:id,admin_id', 'property.owner:id')
            ->whereUuid($request['uuid'])
            ->first();

        if (!$booking || !is_null($booking->cancelled_at) || !$booking->is_paid) {
            throw ValidationException::withMessages([
                'booking' => 'Invalid booking provided or payment already refund.'
            ]);
        }

        $canCancel = $this->canCancelBooking($booking);

        if (!$canCancel) {
            throw ValidationException::withMessages([
                'booking' => 'Invalid booking provided or payment already refund.'
            ]);
        }

        $chargesBreakdown = $this->getCancellationChargesBreakdown($booking);

        if (!count($chargesBreakdown)) {
            throw ValidationException::withMessages([
                'booking' => 'Invalid booking provided or payment already refund.'
            ]);
        }


        try {
            DB::transaction(static function () use ($booking, $chargesBreakdown) {
                // Set the booking as cancelled. Prevents multiple refunds requests
                Booking::whereId($booking->id)->update([
                    'cancelled_at' => now()
                ]);

                Refund::create([
                    'booking_amount' => $chargesBreakdown['bookingAmount'],
                    'commission' => $chargesBreakdown['commission'],
                    'transaction_charges' => $chargesBreakdown['transactionCharges'],
                    'refundable_amount' => $chargesBreakdown['refundableAmount'],
                    'booking_id' => $booking->id,
                    'payment_channel_id' => Payment::ModeMpesa,
                    'user_id' => auth()->id(),
                    'admin_id' => $booking->property->owner->id
                ]);
            });
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Request processed successful. You will be refunded within 24 hours.'
            ]
        ]);
    }

    /**
     * Process the request for paying using paypal.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function processPaypalPaymentRequest(Request $request): JsonResponse
    {
        $uuid = $request['uuid'];

        $payment = Payment::query()
            ->select([
                'id', 'account_number', 'amount', 'booking_id', 'property_id', 'user_id',
            ])
            ->with('booking')
            ->firstWhere('uuid', $uuid);

        if (!$payment) {
            throw ValidationException::withMessages([
                'payment' => 'Invalid payment. Please try again.'
            ]);
        }

        $orderResponse = PayPalController::createOrderRequest($payment->booking_id);

        $paypalOrderID = $orderResponse['results']->id;

        /** @noinspection PhpUnhandledExceptionInspection */
        DB::table('payments')->where('id', $payment->id)
            ->update([
                'paypal_order_id' => $paypalOrderID,
                'request_response_data' => json_encode($orderResponse, JSON_THROW_ON_ERROR),
                'updated_at' => now(),
                'payment_channel_id' => Payment::ModePaypal,
            ]);

        $approveData = collect($orderResponse['links'])->where('rel', 'approve')->first();

        return response()->json([
            'data' => [
                'next' => $approveData->href
            ]
        ]);
    }

    /**
     * Returns the booked dates for a property
     * @param Property $property
     * @return array
     */
    public static function getPropertyBookedDates(Property $property): array
    {
        if ($property->type !== Property::TYPE_VACATION) {
            return [];
        }

        return $property->activeBookingsDates
            ->where('checkout_date', '>=', today())
            ->map(function ($date) {
                return [
                    'checkin_date' => $date->checkin_date,
                    'checkout_date' => $date->checkout_date,
                ];
            })
            ->values()
            ->toArray();
    }
}
