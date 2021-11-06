<?php


namespace AmirVahedix\Comment\Providers;


use AmirVahedix\Comment\Events\CommentSubmittedEvent;
use AmirVahedix\Comment\Listeners\CommentSubmittedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CommentSubmittedEvent::class => [
            CommentSubmittedListener::class
        ]
    ];

    public function boot()
    {

    }
}
