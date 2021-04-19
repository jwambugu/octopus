<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Support\Facades\Cache;

class CacheController extends Controller
{
    /**
     * Return the place data
     * @param string $placeID
     * @return mixed
     */
    public static function cachedPlaceDetails(string $placeID)
    {
        return Cache::remember($placeID, now()->addMonths(), function () use ($placeID) {
            $url = sprintf('https://maps.googleapis.com/maps/api/place/details/json?place_id=%s&key=%s',
                $placeID, config('services.google.maps_api_key'));

            $response = Http::retry(3)->get($url)->json();

            return $response['result']['geometry']['location'];
        });
    }
}
