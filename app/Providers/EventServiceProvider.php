<?php

namespace App\Providers;

use App\Events\CarDeleting;
use App\Events\CarUpdating;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CarUpdating::class => [
            \App\Listeners\DeletePlaces::class,
            \App\Listeners\DeleteUploads::class,
        ],
        CarDeleting::class => [
            \App\Listeners\DeletePlaces::class,
            \App\Listeners\DeleteUploads::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
