<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderIds = Order::query()->pluck('id')->toArray();
        $restaurantIds = Restaurant::query()->pluck('id')->toArray();
        $menuIds = Menu::query()->pluck('id')->toArray();
        $randomMenuId = fake()->randomElement($menuIds);

        $menu = Menu::query()->find($randomMenuId);
        $menuQuantityInStock = $menu->quantity;

        $maxQuantityBasedOnAmount = $menu->price != 0
            ? floor(999999999999.99 / $menu->price)
            : PHP_INT_MAX;
        $maxQuantity = min($menuQuantityInStock, $maxQuantityBasedOnAmount);
        $quantity = fake()->numberBetween(1, $maxQuantity);

        return [
            'order_id' => fake()->randomElement($orderIds),
            'restaurant_id' => fake()->randomElement($restaurantIds),
            'menu_id' => fake()->randomElement($menuIds),
            'quantity' => $quantity,
            'amount' => $menu->price * $quantity,
        ];
    }
}
