<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPropertyRequest;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Property;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

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
     */
    private function createBookingPayment(int $propertyID, int $bookingID, int $userID)
    {
        // Get a new account number
        $accountNumber = $this->generateAccountNumber();

        // Get the property data
        $property = Property::find($propertyID, [
            'id', 'cost_per_night'
        ]);

        // Generate a new uuid
        $uuid = Uuid::uuid4();

        return Payment::create([
            'uuid' => $uuid,
            'account_number' => $accountNumber,
            'amount' => $property->cost_per_night,
            'booking_id' => $bookingID,
            'property_id' => $property->id,
            'user_id' => $userID,
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

        try {
            $booking = Booking::create([
                'checkin_date' => $request['checkin_date'],
                'checkout_date' => $request['checkout_date'],
                'property_id' => $propertyID,
                'user_id' => auth()->id(),
            ]);

            // Add payment
            $payment = $this->createBookingPayment($propertyID, $booking->id, $user->id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Property booked successfully.',
                'next' => \URL::signedRoute('booking.book.lipa-na-mpesa', [
                    'uuid' => $payment->uuid,
                ])
            ]
        ]);
    }

    /**
     * Renders the view for making mpesa payments
     * @param Request $request
     * @param string $uuid
     * @return Application|Factory|View
     */
    public function renderMpesaPaymentView(Request $request, string $uuid)
    {
        // Get the request data
        $user = $request->user();

        // Find the payment using the uuid
        $payment = Payment::whereUuid($uuid)->with('property')->first();

        if (!$payment) {
            abort(404);
        }
        return \view('bookings.payments.mpesa')->with([
            'payment' => $payment,
            'user' => $user,
        ]);
    }

    public function processMpesaPaymentRequest(Request $request)
    {
        return $request;
    }
}
