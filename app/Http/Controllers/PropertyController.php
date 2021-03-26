<?php

namespace App\Http\Controllers;

use App\Models\BookingRating;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Rating;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
        $bedrooms = DB::table('properties')
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
        // Check if we have any query parameters
        $query = $request->query;

        $page = $query->has('page') ? $query->get('page') : 1;
        $propertyTypes = $query->has('property_types') ? $query->get('property_types') : "";
        $bedrooms = $query->has('bedrooms') ? $query->get('bedrooms') : 0;
        $city = $query->has('city') ? $query->get('city') : "";

        // Get the filter data
        $filters = $this->propertyFilterData();

        return view('properties.index')->with([
            'page' => $page,
            'filters' => $filters,
            'queryParams' => [
                'propertyTypes' => $propertyTypes,
                'bedrooms' => $bedrooms,
                'city' => $city
            ]
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

        if ($request->has('property_types')) {
            $propertyType = PropertyType::whereSlug($request->get('property_types'))->first([
                'id'
            ]);

            if ($propertyType) {
                $properties = $properties->whereIn('property_type_id', [$propertyType->id]);
            }
        }

        if ($request->has('bedrooms')) {
            $properties = $properties->whereIn('bedrooms', [$request->get('bedrooms')]);
        }

        if ($request->has('city')) {
            $city = City::whereSlug($request->get('city'))->first([
                'id'
            ]);


            if ($city) {
                $properties = $properties->whereIn('city_id', [$city->id]);
            }
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

        // Apply any sort filters if we have any
        if ($cleanedRequest->has('sortBy')) {
            $properties = $this->applySortingFilter($sortBy, $properties);
        }

        // Sort the properties by the option provided
        $properties = $properties->select([
            'id', 'name', 'slug', 'address', 'cost_per_night', 'property_type_id'
        ])->paginate(30)->appends($cleanedRequest->all());

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
     * @param Property $property
     * @return Application|Factory|View
     */
    public function show(Property $property)
    {
        $property = $property->load('images', 'amenities');
        $property->booking_route = route('booking.property.view', [
            'property' => $property->slug
        ]);

        return view('properties.show')->with([
            'property' => $property
        ]);
    }

    /**
     * Render the view for submitting the property ratings
     * @param Request $request
     * @param Property $property
     * @return Application|Factory|View|RedirectResponse
     */
    public function createPropertyBookingRatingView(Request $request, Property $property)
    {
        // Extract the request data
        $ratingUUID = $request->query->get('uuid');
        $type = $request->query->get('type');

        // Get the rating data
        $rating = Rating::whereUuid($ratingUUID)->first();

        if (!$rating) {
            return redirect()->route('index');
        }

        if ($type == 'guest' && !is_null($rating->guest_ratings)) {
            return redirect()->route('index');
        }

        if ($type == 'host' && !is_null($rating->host_ratings)) {
            return redirect()->route('index');
        }

        // Get the available booking ratings
        $ratings = BookingRating::where([
            'is_active' => true,
            'type' => 'host' // TODO: use type as guest
        ])->get([
            'id', 'title', 'description', 'is_boolean'
        ]);

        $property = $property->load([
            'amenities',
            'owner:id,name,email,phone_number,description',
            'owner.profilePicture:id,admin_id,public_url',
        ]);

        return \view('bookings.ratings.create')->with([
            'property' => $property,
            'uuid' => $bookingUUID,
            'ratings' => $ratings
        ]);
    }

    /**
     * Process the request for submitting a property rating
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createPropertyBookingRating(Request $request): JsonResponse
    {
        // Extract the request data
        $ratings = $request['ratings'];
        $uuid = $request['uuid'];

        try {
            DB::table('ratings')->where('uuid', $uuid)->update([
                'guest_ratings' => json_encode($ratings),
                'updated_at' => now()
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Ratings submitted successfully. Thank you!'
            ]
        ]);
    }
}
