<?php

namespace App\Http\Controllers;

use App\Models\{Property, PropertyType};
use Illuminate\Contracts\{Foundation\Application, Pagination\Paginator, View\Factory, View\View};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * @param Request $request
     * @param string $type
     * @return Application|Factory|View
     */
    public static function getPropertiesView(Request $request, string $type)
    {
        $page = $request->filled('page') ? (int)$request['page'] : 1;
        $name = $type === Property::TYPE_VACATION ? 'Vacations' : 'Leasing / On Sale';

        $propertyTypeData = [
            'type' => $type,
            'name' => $name,
        ];

        $view = $type === Property::TYPE_VACATION ? 'vacations.index' : 'properties.index';

        return view($view)->with([
            'page' => $page,
            'filters' => self::filterData(),
            'queryParams' => self::getPropertiesQueryParameters($request),
            'key' => config('services.google.maps_api_key'),
            'propertyTypeData' => $propertyTypeData
        ]);
    }

    /**
     * Render the properties index page
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return self::getPropertiesView($request, Property::TYPE_SALE);
    }

    /**
     * @param Request $request
     * @param array $types
     * @return Paginator
     */
    public static function getProperties(Request $request, array $types): Paginator
    {
        $request['bedrooms'] = (int)$request['bedrooms'] === 0 ? '' : (int)$request['bedrooms'];

        $properties = Property::ofType($types)
            ->when($request->filled('property_types'), function ($query) use ($request) {
                $propertyType = PropertyType::query()
                    ->select('id')
                    ->firstWhere('slug', $request['property_types']);

                if ($propertyType) {
                    $query->whereIn('property_type_id', [$propertyType->id]);
                }
            })
            ->when($request->filled('bedrooms'), function ($query) use ($request) {
                $query->whereIn('bedrooms', [$request['bedrooms']]);
            })
            ->when($request->filled('address'), function ($query) use ($request) {
                $condition = trim("%{$request['address']}%");

                $query->where('address', 'like', $condition);
            })
            ->when($request->filled('sortBy'), function ($query) use ($request) {
                $options = Property::SORTING_OPTIONS;
                $sortBy = $request['sortBy'];

                if (array_key_exists($sortBy, $options)) {
                    $option = explode(':', $options[$sortBy]);
                    $query->orderBy($option[0], $option[1]);
                }
            });

        $cleanedRequest = collect(array_filter($request->all()));

        /** @noinspection StaticInvocationViaThisInspection */
        return $properties->orderByDesc('id')
            ->simplePaginate(30)
            ->appends($cleanedRequest->all());
    }

    /**
     * @param object $links
     * @param string $from
     * @param string $to
     * @return string
     */
    public static function replaceAPIRoutesOnLinks(object $links, string $from, string $to): string
    {
        return (string)str_replace($from, $to, (string)$links);
    }

    /**
     * Returns the data to use on the properties filter
     * @return array
     */
    public static function filterData(): array
    {
        $propertyTypes = DB::table('property_types')
            ->whereNull('deleted_at')
            ->get(['id', 'name', 'slug']);

        $bedrooms = DB::table('properties')
            ->whereNull('deleted_at')
            ->distinct('bedrooms')
            ->orderBy('bedrooms')
            ->pluck('bedrooms');


        return [
            'cities' => [],
            'bedrooms' => $bedrooms,
            'propertyTypes' => $propertyTypes
        ];
    }

    /**
     * Returns an array with query params if any.
     * @param Request $request
     * @return array
     */
    public static function getPropertiesQueryParameters(Request $request): array
    {
        $query = $request->query;

        $propertyTypes = $query->has('property_types') ? $query->get('property_types') : "";
        $bedrooms = $query->has('bedrooms') ? $query->get('bedrooms') : 0;
        $address = $query->has('address') ? $query->get('address') : "";

        return [
            'propertyTypes' => $propertyTypes,
            'bedrooms' => $bedrooms,
            'city' => "",
            'address' => $address
        ];
    }

    /**
     * Returns the data for the available properties.
     * @param Request $request
     * @return JsonResponse
     */
    public function getAvailableProperties(Request $request): JsonResponse
    {
        $properties = self::getProperties($request, [Property::TYPE_SALE, Property::TYPE_LEASE]);

        $links = self::replaceAPIRoutesOnLinks(
            $properties->links(), route('properties.get-properties'), route('properties.index')
        );

        return response()->json([
            'data' => [
                'properties' => $properties->items(),
                'total' => $properties->count(),
                'links' => $links
            ]
        ]);
    }
}
