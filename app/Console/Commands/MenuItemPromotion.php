<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Menu;
use App\Notifications\MenuItemPromotionNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MenuItemPromotion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promote:menu-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a push notification to all customers every day around noon, promoting one menu-item';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $menu = Menu::query()->inRandomOrder()->cursor()->first();

        try {
            Log::info('Sending menu promotion notification...');

            Customer::query()->whereNotNull('device_token')
                ->lazy()->each(function ($customer) use ($menu) {
                    Notification::send(null,
                        new MenuItemPromotionNotification($menu, $customer->device_token));
                });

            Log::info('Menu promotion notifications sent');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
