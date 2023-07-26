<?php

namespace App\Notifications;

use App\Models\Menu;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class MenuItemPromotionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Menu $menu,
                                protected string $customerDeviceToken)
    {
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
            ->withTitle('Menu of the day' . $this->menu->name)
            ->asMessage($this->customerDeviceToken);
    }
}
