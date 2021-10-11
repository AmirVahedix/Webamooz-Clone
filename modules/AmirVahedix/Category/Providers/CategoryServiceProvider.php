<?php


namespace AmirVahedix\Category\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified'])
            ->prefix('categories')
            ->group(__DIR__.'/../Routes/CategoryRoutes.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Category');

    }
}
