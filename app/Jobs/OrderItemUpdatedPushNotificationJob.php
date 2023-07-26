<?php

namespace App\Jobs;

use App\Mail\OrderCreatedNotification;
use App\Models\OrderItem;
use App\Notifications\OrderItemStatusUpdatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderItemUpdatedPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $title, public string $message,
                                public string $customerDeviceToken)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send(null,
            new OrderItemStatusUpdatedNotification($this->title,
                $this->message, $this->customerDeviceToken));
    }
}
