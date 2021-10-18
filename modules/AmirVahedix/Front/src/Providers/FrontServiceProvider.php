<?php

namespace AmirVahedix\Front\Providers;

use AmirVahedix\Category\Models\Category;
use AmirVahedix\Category\Repositories\CategoryRepo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web'])
            ->group(__DIR__.'/../Routes/FrontRoutes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Front');

        view()->composer("Front::layouts.header.header", function($view) {
            $categories = (new CategoryRepo())->tree();
            $view->with(compact('categories'));
        });
    }

    public function boot()
    {

    }
}
