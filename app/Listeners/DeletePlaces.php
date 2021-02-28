<?php

namespace App\Listeners;

use App\Models\Place;

class DeletePlaces
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        if($event->deletePlaces)
        {
            Place::where('car_id', $event->car->id)->delete();
        };
    }
}
