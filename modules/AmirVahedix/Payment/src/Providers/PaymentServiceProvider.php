<?php

namespace AmirVahedix\Payment\Providers;

use AmirVahedix\Authorization\Models\Permission;
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
        $this->app->register(EventServiceProvider::class);

        Route::middleware(['web', 'auth'])
            ->group(__DIR__.'/../Routes/PaymentRoutes.php');
        Route::middleware(['web', 'auth'])
            ->group(__DIR__.'/../Routes/SettlementRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Payment');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {
        // Add Gateway model to work with adapters
        $this->app->singleton(Gateway::class, function($app) {
            return new ZarinpalAdapter();
        });

        // Add course as a morphed model
        Course::resolveRelationUsing("payments", function($model) {
            return $model->morphMany(Payment::class, "paymentable");
        });

        // Add icon in sidebar
        config()->set('sidebar.items.payments', [
            'icon' => 'i-transactions',
            'title' => 'تراکنش ها',
            'url' => 'admin.payments.index',
            'permission' => [Permission::PERMISSION_MANAGE_PAYMENTS]
        ]);

        config()->set('sidebar.items.my-purchases', [
            'icon' => 'i-my__purchases',
            'title' => 'خریدهای من',
            'url' => 'purchases.index',
        ]);

        config()->set('sidebar.items.settlement-request', [
            'icon' => 'i-checkout__request',
            'title' => 'درخواست تسویه',
            'url' => 'dashboard.settlements.create',
            'permission' => [Permission::PERMISSION_TEACH]
        ]);
    }
}
