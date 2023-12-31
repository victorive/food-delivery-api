<?php

namespace App\Providers;

use App\Events\OrderCreated;
use App\Events\OrderItemStatusUpdated;
use App\Listeners\SendOrderCreatedMailNotification;
use App\Listeners\SendOrderItemStatusUpdatedPushNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        OrderCreated::class => [
            SendOrderCreatedMailNotification::class,
        ],
        OrderItemStatusUpdated::class => [
            SendOrderItemStatusUpdatedPushNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
