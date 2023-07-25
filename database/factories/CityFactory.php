<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stateIds = State::query()->pluck('id')->toArray();

        return [
            'name' => fake()->city(),
            'state_id' => fake()->randomElement($stateIds),
        ];
    }
}
