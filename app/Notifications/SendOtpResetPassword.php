<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendOtpResetPassword extends Notification  implements ShouldQueue
{
    use Queueable;

    public $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $otp = $this->otp->generate($notifiable->email , 'numeric' , 5 , 40);
        return (new MailMessage)
                    ->greeting('Otp Code')
                    ->line('Rest Password Verification Code .')
                    ->line('Code : '.$otp->token );
    }


    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
