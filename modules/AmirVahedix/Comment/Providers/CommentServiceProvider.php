<?php

namespace AmirVahedix\Comment\Providers;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Comment\Models\Comment;
use AmirVahedix\Comment\Policies\CommentPolicy;
use AmirVahedix\User\Models\User;
use Illuminate\Support\Facades\Gate;
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

        Gate::policy(Comment::class, CommentPolicy::class);
        Gate::before(function(User $user) {
           return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
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
