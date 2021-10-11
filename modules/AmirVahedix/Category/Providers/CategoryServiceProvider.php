<?php


namespace AmirVahedix\Category\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified', 'permission:manage_categories'])
            ->prefix('categories')
            ->group(__DIR__.'/../Routes/CategoryRoutes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Category');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function boot()
    {
        config()->set('sidebar.items.categories', [
            'icon' => 'i-categories',
            'title' => 'دسته‌بندی ها',
            'url' => 'admin.categories.index'
        ]);
    }
}
