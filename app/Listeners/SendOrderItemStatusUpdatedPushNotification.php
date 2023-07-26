<?php

namespace App\Listeners;

use App\Enums\OrderItemConfirmationStatus;
use App\Jobs\OrderItemUpdatedPushNotificationJob;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderItemStatusUpdatedPushNotification
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
        $customerDeviceToken = $event->orderItem->order->customer->device_token;

        $status = match ($event->orderItem->confirmation_status) {
            OrderItemConfirmationStatus::ACCEPTED->value => 'accepted',
            OrderItemConfirmationStatus::REJECTED->value => 'rejected',
            default => 'pending',
        };

        $title = 'Order Status Updated';

        $message = "Your order item was {$status} by the restaurant";

        OrderItemUpdatedPushNotificationJob::dispatch($title, $message, $customerDeviceToken)->delay(now()->addSeconds(5));
    }
}
