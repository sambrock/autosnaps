<?php

use App\Http\Controllers\GooglePlacesController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/places', [GooglePlacesController::class, 'getPlaces']);
Route::get('/places/{id}', [GooglePlacesController::class, 'getPlaceById']);

Route::get('/map/markers', [MapController::class, 'getMarkers']);
