<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    /**
     * Fetch the booked dates for a property
     * @param int $id
     * @return JsonResponse
     */
    public function getBookedDates(int $id): JsonResponse
    {
        $property = Property::find($id);

        if (!$property) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Invalid property provided.'
            ], Response::HTTP_NOT_FOUND);
        }

        $bookedDates = $property->activeBookingsDates->map(function ($date) {
            return [
                'checkin_date' => $date->checkin_date,
                'checkout_date' => $date->checkout_date,
            ];
        });

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => [
                'bookedDates' => $bookedDates
            ]
        ]);
    }
}
