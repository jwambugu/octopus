<?php

namespace App\Http\Controllers;

use App\Models\{Property, PropertyType};
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('properties.index');
    }

    /**
     * @param Request $request
     * @param string $type
     * @return Paginator
     */
    public static function getProperties(Request $request, string $type): Paginator
    {
        $request['bedrooms'] = (int)$request['bedrooms'] === 0 ? '' : (int)$request['bedrooms'];

        $properties = Property::ofType($type)
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
}
