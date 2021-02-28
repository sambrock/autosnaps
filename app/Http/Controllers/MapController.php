<?php

namespace App\Http\Controllers;

use App\Models\Car;

class MapController extends Controller
{
    public function index()
    {
        return view('map/index');
    }
    
    public function getMarkers()
    {
        $markers = Car::all();

        $markers = $markers->groupBy('location')->map(function ($item) {
            return ['place_id' => $item[0]->place_id, 'location' => $item[0]->location, 'lng' => $item[0]->lng, 'lat' => $item[0]->lat, 'count' => $item->count()];
        })->unique()->sortByDesc('count');

        $markers = $markers->slice(0, 15);

        return $markers->toJson();
    }
}
