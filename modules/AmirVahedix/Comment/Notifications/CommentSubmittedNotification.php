<?php

namespace AmirVahedix\Comment\Notifications;

use AmirVahedix\Comment\Mail\CommentSubmittedMail;
use AmirVahedix\Comment\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kavenegar\LaravelNotification\KavenegarChannel;
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
        $channels = [];

        if ($notifiable->email) $channels[] = 'mail';
        if ($notifiable->telegram) $channels[] = TelegramChannel::class;
        if ($notifiable->mobile) $channels[] = KavenegarChannel::class;

        return $channels;
    }

    public function toMail($notifiable): CommentSubmittedMail
    {
        return (new CommentSubmittedMail($this->comment))
            ->to($notifiable->email);
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->telegram)
            ->content("یک دیدگاه جدید برای دوره شما در وب آموز ارسال شده است.")
            ->button('مشاهده دوره', route('courses.single', $this->comment->commentable->slug))
            ->button('مدیریت کامنت‌ها', route('dashboard.comments.index'));
    }

    public function toSMS($notifiable): string
    {
        return "یک دیدگاه جدید برای دوره {$this->comment->commentable->title} ارسال شده است.";
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
