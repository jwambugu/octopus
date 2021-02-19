<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Returns the data to use on the properties filter
     * @return array
     */
    private function propertyFilterData(): array
    {
        // Get the property types
        $propertyTypes = DB::table('property_types')
            ->whereNull('deleted_at')
            ->get(['id', 'name', 'slug']);

        // Get the distinct bedrooms we have in the db
        $bedrooms = \DB::table('properties')
            ->whereNull('deleted_at')
            ->distinct('bedrooms')
            ->orderBy('bedrooms')
            ->pluck('bedrooms');

        // Get the available cities
        $cities = DB::table('cities')
            ->whereNull('deleted_at')
            ->get(['id', 'name', 'slug']);


        return [
            'cities' => $cities,
            'bedrooms' => $bedrooms,
            'propertyTypes' => $propertyTypes
        ];
    }

    /**
     * Render the properties index page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        // Check if we have a page query parameter
        $page = $request->query->has('page') ? $request->query->get('page') : 1;

        // Get the filter data
        $filters = $this->propertyFilterData();

        return view('properties.index')->with([
            'page' => $page,
            'filters' => $filters,
        ]);
    }

    /**
     * Apply any of the filters if we have any
     * @param object $request
     * @param $properties
     * @return mixed
     */
    private function applyPropertyFiltersIfAny(object $request, $properties)
    {

        if ($request->has('propertyTypes')) {
            $properties = $properties->whereIn('property_type_id', [$request->get('propertyTypes')]);
        }

        if ($request->has('bedrooms')) {
            $properties = $properties->whereIn('bedrooms', [$request->get('bedrooms')]);
        }

        if ($request->has('city')) {
            $properties = $properties->whereIn('city_id', [$request->get('city')]);
        }

        return $properties;
    }

    /**
     * Sorts the properties as per the filter applied.
     * @param string $sortOption
     * @param object $properties
     * @return object
     */
    private function applySortingFilter(string $sortOption, object $properties): object
    {
        switch ($sortOption) {
            case '_price_asc':
            {
                return $properties->orderBy('cost_per_night');
            }
            case '_price_desc':
            {
                return $properties->orderByDesc('cost_per_night');
            }
            case '_time_added_asc' :
            {
                return $properties->orderBy('created_at');
            }
            case '_time_added_desc' :
            {
                return $properties->orderByDesc('created_at');
            }
            default:
            {
                return $properties;
            }
        }
    }

    /**
     * Returns the data for the available properties.
     * @param Request $request
     * @return JsonResponse
     */
    public function getProperties(Request $request): JsonResponse
    {
        // Remove all the empty route parameters
        $cleanedRequest = collect(array_filter($request->all()));
        $sortBy = $cleanedRequest->get('sortBy');

        // Get the properties that are available and have been approved.
        $properties = Property::with('amenities', 'images')->where([
            'is_available' => true,
            'status' => 'approved',
        ]);

        // Apply any filters if we have any
        $properties = $this->applyPropertyFiltersIfAny($cleanedRequest, $properties);

        if ($cleanedRequest->has('sortBy')) {
            $properties = $this->applySortingFilter($sortBy, $properties);
        }
        // Sort the properties by the option provided

        $properties = $properties->select([
            'id', 'name', 'slug', 'address', 'cost_per_night', 'property_type_id'
        ])->paginate(10)->appends($cleanedRequest->all());

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

    /**
     * Shows a single property
     * @param Request $request
     * @param Property $property
     * @return Application|Factory|View
     */
    public function show(Request $request, Property $property)
    {
        $property = $property->load('images', 'amenities');

        return view('properties.show')->with([
            'property' => $property
        ]);
    }
}
