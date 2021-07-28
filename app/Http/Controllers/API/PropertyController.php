<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    /**
     * Fetch the booked dates for a property
     * @param int $id
     */
    public function getBookedDates(int $id)
    {
        $property = Property::find($id);

        return [
            $property, $property->activeBookingsDates
        ];

        if (!$property) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Invalid property provided.'
            ], Response::HTTP_NOT_FOUND);
        }

        $bookedDates = BookingController::getPropertyBookedDates($property);

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => [
                'bookedDates' => $bookedDates
            ]
        ]);
    }
}
