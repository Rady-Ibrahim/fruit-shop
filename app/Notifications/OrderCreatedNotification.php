<?php

namespace App\Notifications;

use App\Models\order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $order;

    public function __construct(order $order)
    {
        $this->order = $order;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];

        $channels = ['database'];

        if ($notifiable->notification_preference['order_created'] ['email'] ?? false) {
            $channels[] = 'mail';
        }
        if ($notifiable->notification_preference['order_created'] ['sms'] ?? false) {
            $channels[] = 'nexmo';
        }
        if ($notifiable->notification_preference['order_created'] ['broadcast'] ?? false) {
            $channels[] = 'broadcast';
        }
        return $channels;


    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
