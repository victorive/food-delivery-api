<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\DeliveryAgent;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerIds = Customer::query()->pluck('id')->toArray();
        $deliveryAgentIds = DeliveryAgent::query()->pluck('id')->toArray();
        $paymentMethodIds = PaymentMethod::query()->pluck('id')->toArray();

        return [
            'customer_id' => fake()->randomElement($customerIds),
            'delivery_agent_id' => fake()->randomElement($deliveryAgentIds),
            'total_amount' => fake()->randomFloat(2),
            'payment_method_id' => fake()->randomElement($paymentMethodIds),
            'status' => fake()->numberBetween(0, 2),
        ];
    }
}
