<?php

namespace AmirVahedix\Payment\Providers;

use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Gateways\Zarinpal\ZarinpalAdapter;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app) {
            return new ZarinpalAdapter();
        });
    }
}
