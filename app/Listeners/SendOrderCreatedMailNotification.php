<?php

namespace App\Listeners;

use App\Jobs\OrderCreatedNotificationJob;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedMailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $adminEmail = Admin::query()->first()->email;

        $restaurantEmails = $event->order->orderItems->pluck('restaurant.email')->toArray();

        $recipients = array_merge([$adminEmail], $restaurantEmails);

        OrderCreatedNotificationJob::dispatch($recipients, $event->order)->delay(now()->addSeconds(5));
    }
}
