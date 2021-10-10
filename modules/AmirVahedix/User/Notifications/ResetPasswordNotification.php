<?php

namespace AmirVahedix\User\Notifications;

use AmirVahedix\User\Mail\ResetPasswordMail;
use AmirVahedix\User\Mail\VerifyCodeMail;
use AmirVahedix\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code);

        return (new ResetPasswordMail($code))
            ->to($notifiable->email);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
