<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SKAgarwal\GoogleApi\PlacesApi;

class GooglePlacesController extends Controller
{
    public function getPlaces(Request $request)
    {
        $search = $request->input('search');

        $place = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));
        $response = $place->placeAutocomplete($search, ['types' => '(cities)']);

        return response()->json($response);
    }

    public function getPlaceById($id)
    {
        $place = new PlacesApi(env('GOOGLE_PLACES_API_KEY'));
        $response = $place->placeDetails($id);

        return response()->json(['place_id' => $id, 'response' => $response]);
    }
}
