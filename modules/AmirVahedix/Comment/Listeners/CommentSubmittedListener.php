<?php

namespace AmirVahedix\Comment\Listeners;

use AmirVahedix\Comment\Notifications\CommentSubmittedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentSubmittedListener
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $event->comment
            ->commentable
            ->teacher
            ->notify(new CommentSubmittedNotification($event->comment));
    }
}
