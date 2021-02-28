<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SKAgarwal\GoogleApi\PlacesApi;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PlacesApi::class, function() {
            return new PlacesApi(config('services.google_places.api_key'));
        });
    }

    public function boot()
    {
        //
    }
}
