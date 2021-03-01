<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
}
