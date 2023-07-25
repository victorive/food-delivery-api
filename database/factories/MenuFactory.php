<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restaurantIds = Restaurant::query()->pluck('id')->toArray();

        return [
            'restaurant_id' => fake()->randomElement($restaurantIds),
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2),
            'quantity' => fake()->randomNumber(),
            'is_available' => fake()->boolean(),
        ];
    }
}
