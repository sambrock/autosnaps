<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $car;

    public function __construct($car)
    {
        $this->car = $car;
        $this->deleteImages = $car->imagesAdded;
        $this->deletePlaces = $car->isDirty('place_id');
    }
}
