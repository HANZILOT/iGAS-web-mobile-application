<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */

     protected $observers = [
        \App\Models\GasolineFee::class => [
            \App\Observers\GasolineFeeObserver::class
        ],
        \App\Models\GasolineStation::class => [
            \App\Observers\GasolineStationObserver::class
        ],
        \App\Models\User::class => [
            \App\Observers\StaffObserver::class
        ],
        \App\Models\Service::class => [
            \App\Observers\ServiceObserver::class
        ],
        \App\Models\User::class => [
            \App\Observers\StaffObserver::class
        ],
    ];
    
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}