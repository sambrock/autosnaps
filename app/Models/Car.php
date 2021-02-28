<?php

namespace App\Models;

use App\Events\CarDeleting;
use App\Events\CarUpdating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SKAgarwal\GoogleApi\PlacesApi;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = true;

    protected $dispatchesEvents = [
        'updating' => CarUpdating::class,
        'deleting' => CarDeleting::class,
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function carModel()
    {
        return $this->hasOne(CarModel::class, 'id', 'model_id');
    }

    public function carMake()
    {
        return $this->hasOneThrough( CarMake::class, CarModel::class, 'id', 'id', 'model_id', 'make_id' );
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    public function place()
    {
        return $this->hasMany(Place::class);
    }

    public function location()
    {
        $place = new PlacesApi(config('services.google_places.api_key'));
        $response = $place->placeDetails($this->place_id);

        return $response['result']['formatted_address'];
    }

    public function getCarNameAttribute()
    {
        return "{$this->carMake->name} {$this->carModel->name}";
    }
}
