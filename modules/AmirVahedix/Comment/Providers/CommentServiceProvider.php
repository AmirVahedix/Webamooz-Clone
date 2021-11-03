<?php

namespace AmirVahedix\Comment\Providers;


use AmirVahedix\Authorization\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth'])
            ->group(__DIR__.'/../Routes/CommentRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Comment');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {
        config()->set('sidebar.items.comments', [
            'icon' => 'i-comments',
            'title' => 'نظرات',
            'url' => 'dashboard.comments.index',
            'permission' => Permission::PERMISSION_MANAGE_COMMENTS
        ]);
    }
}
