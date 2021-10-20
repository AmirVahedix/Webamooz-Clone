<?php


namespace AmirVahedix\Course\Providers;

use AmirVahedix\Course\Listeners\AttendUserToCourseListener;
use AmirVahedix\Payment\Events\SuccessfulPaymentEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SuccessfulPaymentEvent::class => [
            AttendUserToCourseListener::class
        ]
    ];

    public function boot()
    {

    }
}
