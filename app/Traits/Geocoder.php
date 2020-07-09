<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait Geocoder
{
    public function geocode($query, $limit = 5)
    {
        $cached = Cache::store('file')->get(mb_strtolower($query));

        if ($cached) {
            Log::info(json_encode([
                "query" => $query,
                "results" => $cached,
                'cached' => true,
            ]));
            return $cached;
        }

        $locations = [];

        $apiUrl = config('geocode.yandex_maps.api_url');
        $apiKey = config('geocode.yandex_maps.api_key');

        try {
            $response = Http::get($apiUrl, [
                'apikey' => $apiKey,
                'geocode' => $query,
                'results' => $limit,
                'format' => 'json',
            ]);

            $locations = $this->format($response->json()['response']['GeoObjectCollection']['featureMember'], $query);

            Log::info(json_encode([
                "query" => $query,
                "results" => $locations,
                'cached' => false,
            ]));

        } catch (\Exception $e) {}

        return $locations;
    }

    public function format($data, $query)
    {
        $locations = [];

        if (count($data)) {
            foreach ($data as $value) {
                $location = $value['GeoObject'];
                $locations[] = [
                    "name" => $location["name"],
                    "description" => isset($location["description"]) ?
                    $location["description"] : null,
                    "coordinates" => $location["Point"]["pos"],
                    "meta" => $location["metaDataProperty"]["GeocoderMetaData"]["Address"]["Components"],
                ];
            }

            Cache::store('file')->put(mb_strtolower($query), $locations, 900);
        }

        return $locations;
    }
}
