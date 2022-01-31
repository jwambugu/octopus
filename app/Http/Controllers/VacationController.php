<?php

namespace App\Http\Controllers;

use App\Models\{BookingRating, Property, PropertyType, Rating};
use Exception;
use Illuminate\Contracts\{Foundation\Application, View\Factory, View\View};
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Support\Facades\DB;
use RuntimeException;

class VacationController extends Controller
{

    /**
     * Render the properties index page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Factory|View|Application
    {
        return PropertyController::getPropertiesView($request, Property::TYPE_VACATION);
    }

    /**
     * Returns the data for the vacation types we have in the system.
     * @return JsonResponse
     */
    public function getAvailableVacationTypes(): JsonResponse
    {
        $vacationTypes = PropertyType::query()
            ->select([
                'id', 'name', 'slug'
            ])
            ->whereHas('properties')
            ->where('is_active', true)
            ->withCount('properties')
            ->get()
            ->map(function ($propertyType) {
                $name = ucwords(strtolower($propertyType->name));
                $hasSlashes = (bool)strpos($name, '/');

                if ($hasSlashes) {
                    $name = collect(explode('/', $name))->map(function ($value) {
                        return ucwords(strtolower(trim($value)));
                    })->implode('/');
                }

                return [
                    'id' => $propertyType->id,
                    'name' => $name,
                    'slug' => $propertyType->slug,
                    'count' => $propertyType->properties_count,
                    '_route' => route('vacations.index', [
                        'property_types' => $propertyType->slug
                    ])
                ];
            })->sortByDesc(function ($propertyType) {
                return strlen($propertyType['slug']);
            })->values();

        return response()->json([
            'data' => [
                'vacationTypes' => $vacationTypes
            ]
        ]);
    }

    /**
     * Returns the data for the available vacations.
     * @param Request $request
     * @return JsonResponse
     */
    public function getVacations(Request $request): JsonResponse
    {
        $properties = PropertyController::getProperties($request, [Property::TYPE_VACATION]);

        $links = PropertyController::replaceAPIRoutesOnLinks(
            $properties->links(), route('vacations.fetch-vacations'), route('index')
        );

        return response()->json([
            'data' => [
                'properties' => $properties->items(),
                'total' => $properties->count(),
                'links' => $links
            ]
        ]);
    }

    /**
     * Shows a single property
     * @param Property $property
     * @return Application|Factory|View
     * @noinspection CallableParameterUseCaseInTypeContextInspection
     */
    public function show(Property $property): View|Factory|Application
    {
        return view('vacations.show')->with([
            'property' => PropertyController::getProperty($property)
        ]);
    }

    /**
     * Render the view for submitting the property ratings
     * @param Request $request
     * @param Property $property
     * @return Application|Factory|View|RedirectResponse
     * @noinspection CallableParameterUseCaseInTypeContextInspection
     */
    public function createPropertyBookingRatingView(Request $request, Property $property): View|Factory|RedirectResponse|Application
    {
        $ratingUUID = $request->query->get('uuid');
        $type = $request->query->get('type');

        $rating = Rating::whereUuid($ratingUUID)->first();

        if (!$rating) {
            return redirect()->route('index');
        }

        if ($type === 'guest' && !is_null($rating->guest_ratings)) {
            return redirect()->route('index');
        }

        if ($type === 'host' && !is_null($rating->host_ratings)) {
            return redirect()->route('index');
        }

        $ratings = BookingRating::where([
            'is_active' => true,
            'type' => 'guest'
        ])->get([
            'id', 'title', 'description', 'is_boolean'
        ]);

        $property = $property->load([
            'amenities',
            'owner:id,name,email,phone_number,description',
            'owner.profilePicture:id,admin_id,public_url',
        ]);

        return view('bookings.ratings.create')->with([
            'property' => $property,
            'uuid' => $ratingUUID,
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
        $ratings = $request['ratings'];
        $uuid = $request['uuid'];

        try {
            DB::table('ratings')->where('uuid', $uuid)->update([
                'guest_ratings' => json_encode($ratings, JSON_THROW_ON_ERROR),
                'updated_at' => now()
            ]);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Ratings submitted successfully. Thank you!'
            ]
        ]);
    }

    /**
     * Returns the properties with the highest number of vacation bookings
     * @return JsonResponse
     */
    public function getPopularVacations(): JsonResponse
    {
        $topBookings = DB::table('bookings AS b')
            ->select('b.property_id', DB::raw('COUNT(b.property_id) AS count'))
            ->join('properties AS p', 'b.property_id', '=', 'p.id')
            ->where([
                'p.is_available' => true,
                'p.status' => 'approved',
                'p.type' => Property::TYPE_VACATION,
                'b.is_paid' => true
            ])
            ->groupBy(['property_id'])
            ->orderByDesc('count')
            ->take(5)
            ->get();

        $propertiesIDs = $topBookings->pluck('property_id');

        $properties = Property::ofType([Property::TYPE_VACATION])
            ->whereIn('properties.id', $propertiesIDs)
            ->get();

        return response()->json([
            'data' => [
                'properties' => $properties
            ]
        ]);
    }
}
