<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Geocoder;

class GeocoderController extends Controller
{
    use Geocoder;

    public function search(Request $request, $address)
    {
    	return response()->json($this->geocode($address));
    }
}
