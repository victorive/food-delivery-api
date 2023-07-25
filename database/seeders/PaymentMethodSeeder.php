<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(['cash on delivery', 'paypal', 'stripe'])->map(function ($value) {
            PaymentMethod::query()->create([
                'name' => $value
            ]);
        });
    }
}
