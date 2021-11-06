<?php

namespace AmirVahedix\Comment\Mail;

use AmirVahedix\Comment\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function build(): CommentSubmittedMail
    {
        return $this->markdown('Comment::mails.CommentSubmitted')
            ->subject('ثبت دیدگاه جدید - وب آموز');
    }
}
