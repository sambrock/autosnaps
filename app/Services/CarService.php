<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SKAgarwal\GoogleApi\PlacesApi;

class CarService
{
  public function placeCoords($place_id, PlacesApi $place)
  {
    $response = $place->placeDetails($place_id);
    return [
      'lng' => $response['result']['geometry']['location']['lng'],
      'lat' => $response['result']['geometry']['location']['lat']
    ];
  }

  public function carData($validated, PlacesApi $place)
  {
    $attributes = $validated;

    unset($attributes['images']); // Remove, only used for validation

    $attributes['user_id'] = Auth::id();

    $coords = $this->placeCoords($attributes['place_id'], $place);
    $attributes['lng'] = $coords['lng'];
    $attributes['lat'] = $coords['lat'];

    return $attributes;
  }

  public function placeData($place_id, PlacesApi $place)
  {
    $response = $place->placeDetails($place_id);

    $names = collect($response['result']['address_components'])->map(function ($item) {
      return $item['long_name'];
    })->unique();

    $placeData = $names->map(function ($item) use ($place) {
      $response = $place->placeAutocomplete($item);
      return [
        'place_id' => $response['predictions'][0]['place_id']
      ];
    });

    return $placeData;
  }
}
