<?php


namespace AmirVahedix\Discount\Providers;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Discount\Models\Discount;
use AmirVahedix\Discount\Policies\DiscountPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth'])
            ->prefix('dashboard/discounts')
            ->group(__DIR__.'/../Routes/DiscountRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Discount');

        Gate::policy(Discount::class, DiscountPolicy::class);
        Gate::before(function($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.discounts', [
            'icon' => 'i-discounts',
            'title' => 'تخفیف ها',
            'url' => 'admin.discounts.index',
            'permission' => [Permission::PERMISSION_MANAGE_DISCOUNTS]
        ]);
    }
}
