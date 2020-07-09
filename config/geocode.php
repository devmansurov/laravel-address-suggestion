<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Geocode Services Configuration
    |--------------------------------------------------------------------------
    |
    */

    'yandex_maps' => [
    	'api_url' => env('YANDEX_MAPS_API_URL', null),
    	'api_key' => env('YANDEX_MAPS_API_KEY', null),
    ]

];
