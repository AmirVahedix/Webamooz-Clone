<?php


namespace AmirVahedix\Payment\Providers;

use AmirVahedix\Discount\Listeners\UpdateDiscountAfterPayment;
use AmirVahedix\Payment\Events\SuccessfulPaymentEvent;
use AmirVahedix\Payment\Listeners\AddSellerShareToAccount;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SuccessfulPaymentEvent::class => [
            AddSellerShareToAccount::class,
            UpdateDiscountAfterPayment::class
        ]
    ];

    public function boot()
    {

    }
}
