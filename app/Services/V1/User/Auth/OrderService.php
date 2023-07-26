<?php

namespace App\Services\V1\User\Auth;

use App\Repositories\Contracts\MenuRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\RestaurantRepository;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(private OrderRepository      $orderRepository,
                                private MenuRepository       $menuRepository,
                                private RestaurantRepository $restaurantRepository)
    {
    }

    public function createOrder(array $formData, int $customerId)
    {
        return DB::transaction(function () use ($formData, $customerId) {

            $order = $this->orderRepository->create([
                'customer_id' => $customerId
            ]);

            $orderTotal = $this->createOrderItems($formData, $order);

            $order->update(['total_amount' => $orderTotal]);

            return $order;
        });
    }

    private function createOrderItems(array $formData, $order): float|int
    {
        $totalAmount = 0;

        foreach ($formData['order_items'] as $item) {
            $restaurant = $this->restaurantRepository->findByUlid($item['restaurant_ulid']);
            $menu = $this->menuRepository->findByUlid($item['menu_ulid']);

            $amount = ($item['quantity'] * $menu->price);

            $totalAmount += $amount;

            $order->orderItems()->create([
                'restaurant_id' => $restaurant->id,
                'menu_id' => $menu->id,
                'quantity' => $item['quantity'],
                'amount' => $amount,
            ]);
        }

        return $totalAmount;
    }
}
