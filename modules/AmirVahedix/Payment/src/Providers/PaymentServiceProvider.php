<?php

namespace AmirVahedix\Payment\Providers;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Payment\Gateways\Gateway;
use AmirVahedix\Payment\Gateways\Zarinpal\ZarinpalAdapter;
use AmirVahedix\Payment\Models\Payment;
use AmirVahedix\Payment\Models\Settlement;
use AmirVahedix\Payment\Policies\PaymentPolicy;
use AmirVahedix\Payment\Policies\SettlementPolicy;
use AmirVahedix\User\Models\User;
use Illuminate\Support\Facades\Gate;
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

        Gate::policy(Payment::class, PaymentPolicy::class);
        Gate::policy(Settlement::class, SettlementPolicy::class);

        Gate::before(function($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
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

        config()->set('sidebar.items.checkouts', [
            'icon' => 'i-checkouts',
            'title' => 'تسویه حساب‌ها',
            'url' => 'dashboard.settlements.index',
            'permission' => [Permission::PERMISSION_TEACH]
        ]);
    }
}
