<?php

namespace AmirVahedix\Payment\Providers;

use AmirVahedix\Course\Models\Course;
use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Gateways\Zarinpal\ZarinpalAdapter;
use AmirVahedix\Payment\Models\Payment;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware('web')
            ->group(__DIR__.'/../Routes/PaymentRoutes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app) {
            return new ZarinpalAdapter();
        });

        Course::resolveRelationUsing("payments", function($model) {
            return $model->morphMany(Payment::class, "paymentable");
        });
    }
}