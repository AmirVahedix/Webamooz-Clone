<?php

namespace AmirVahedix\Comment\Notifications;

use AmirVahedix\Comment\Mail\CommentSubmittedMail;
use AmirVahedix\Comment\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class CommentSubmittedNotification extends Notification
{
    use Queueable;

    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable): array
    {
        return ['mail', TelegramChannel::class];
    }

    public function toMail($notifiable): CommentSubmittedMail
    {
        return (new CommentSubmittedMail($this->comment))
            ->to($notifiable->email);
    }

    public function toTelegram()
    {
        return TelegramMessage::create()
            ->to(970171405)
            ->content("یک دیدگاه جدید برای دوره شما در وب آموز ارسال شده است.")
            ->button('مشاهده دوره', route('courses.single', $this->comment->commentable->slug))
            ->button('مدیریت کامنت‌ها', route('dashboard.comments.index'));
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
