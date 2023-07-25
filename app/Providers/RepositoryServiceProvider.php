<?php

namespace App\Providers;

use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\DeliveryAgentRepository;
use App\Repositories\Contracts\MenuRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\RestaurantRepository;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use App\Repositories\Eloquent\DeliveryAgentRepositoryEloquent;
use App\Repositories\Eloquent\MenuRepositoryEloquent;
use App\Repositories\Eloquent\OrderRepositoryEloquent;
use App\Repositories\Eloquent\RestaurantRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, CustomerRepositoryEloquent::class);
        $this->app->bind(RestaurantRepository::class, RestaurantRepositoryEloquent::class);
        $this->app->bind(DeliveryAgentRepository::class, DeliveryAgentRepositoryEloquent::class);
        $this->app->bind(MenuRepository::class, MenuRepositoryEloquent::class);
        $this->app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
