<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class OrderItemStatusUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $title, protected string $message,
                                protected string $customerDeviceToken)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['firebase'];
    }
    public function toFirebase(object $notifiable): MailMessage
    {
        return (new FirebaseMessage())
                    ->withTitle($this->title)
                    ->withBody($this->message)
                    ->asMessage($this->customerDeviceToken);
    }
}
