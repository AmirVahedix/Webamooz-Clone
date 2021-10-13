<?php


namespace AmirVahedix\Course\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified'])
            ->group(__DIR__.'/../Routes/CourseRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Course');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {
        config()->set('sidebar.items.courses', [
            'icon' => 'i-courses',
            'title' => 'دوره ها',
            'url' => 'admin.courses.index'
        ]);
    }
}
