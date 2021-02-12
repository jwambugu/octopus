<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Check if we have a page query parameter
        $page = $request->query->has('page') ? $request->query->get('page') : 1;

        return view('properties.index')->with([
            'page' => $page,
        ]);
    }

    /**
     * Returns the data for the available properties.
     * @param Request $request
     * @return JsonResponse
     */
    public function getProperties(Request $request): JsonResponse
    {
        // Get the properties that are available and have been approved.
        $properties = Property::with('amenities', 'images')->where([
            'is_available' => true,
            'status' => 'approved',
        ])->select([
            'id', 'name', 'slug', 'address', 'cost_per_night'
        ])->paginate(10);

        $properties = $properties->appends($request->all());

        $apiRoute = route('properties.fetch-properties');
        $viewRoute = route('properties.index');
        $links = str_replace($apiRoute, $viewRoute, (string)$properties->links());

        return response()->json([
            'data' => [
                'properties' => $properties->items(),
                'total' => $properties->total(),
                'lastPage' => $properties->lastPage(),
                'currentPage' => $properties->currentPage(),
                'links' => (string)$links
            ]
        ]);
    }
}
