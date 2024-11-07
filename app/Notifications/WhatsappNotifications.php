<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WhatsApp\Component;
use NotificationChannels\WhatsApp\WhatsAppChannel;
use NotificationChannels\WhatsApp\WhatsAppTemplate;
class WhatsappNotifications extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return [WhatsAppChannel::class];
    }



    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    public function toWhatsapp($notifiable)
    {
        return WhatsAppTemplate::create()
            ->name('hello_world') // Name of your configured template
            // ->header(Component::image('https://lumiere-a.akamaihd.net/v1/images/image_c671e2ee.jpeg'))
            // ->body(Component::text('Welcome and congratulations!! This message demonstrates your ability to send a WhatsApp message notification from the Cloud API, hosted by Meta. Thank you for taking the time to test with us.WhatsApp Business Platform sample message'))
            // ->body(Component::dateTime(new \DateTimeImmutable))
            // ->body(Component::text('Welcome and congratulations!! This message demonstrates your ability to send a WhatsApp message notification from the Cloud API, hosted by Meta. Thank you for taking the time to test with us.WhatsApp Business Platform sample message'))
            // ->buttons(Component::quickReplyButton(['Thanks for your reply!']))
            // ->buttons(Component::urlButton(['reply/01234'])) // List of url suffixes
            ->to('201225749025');
    }
}
