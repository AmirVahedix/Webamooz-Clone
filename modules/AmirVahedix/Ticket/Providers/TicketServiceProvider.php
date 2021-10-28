<?php


namespace AmirVahedix\Ticket\Providers;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Ticket\Models\Reply;
use AmirVahedix\Ticket\Models\Ticket;
use AmirVahedix\Ticket\Policies\ReplyPolicy;
use AmirVahedix\Ticket\Policies\TicketPolicy;
use AmirVahedix\User\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Ticket');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        Route::middleware(['web', 'auth'])
            ->prefix('dashboard/tickets')
            ->group(__DIR__.'/../Routes/TicketRoutes.php');

        Gate::policy(Ticket::class, TicketPolicy::class);
        Gate::policy(Reply::class, ReplyPolicy::class);
        Gate::before(function(User $user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.tickets', [
            'icon' => 'i-tickets',
            'title' => 'تیکت‌های پشتیبانی',
            'url' => 'dashboard.tickets.index'
        ]);
    }
}
