<?php


namespace AmirVahedix\Discount\Providers;

use AmirVahedix\Authorization\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth'])
            ->group(__DIR__.'/../Routes/DiscountRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
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
