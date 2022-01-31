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
    public static function cachedPlaceDetails(string $placeID): mixed
    {
        return Cache::remember($placeID, now()->addMonths(), static function () use ($placeID) {
            $key = config('services.google.maps_api_key');

            $url = sprintf('https://maps.googleapis.com/maps/api/place/details/json?place_id=%s&key=%s',
                $placeID, $key);

            $response = Http::retry(3)->get($url)->json();

            return $response['result']['geometry']['location'];
        });
    }
}
