<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarDeleting
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $car;
    public $uploads;

    public function __construct($car)
    {
        $this->car = $car;
        $this->uploads = $car->uploads;
        $this->deleteImages = true;
        $this->deletePlaces = true;
    }
}
