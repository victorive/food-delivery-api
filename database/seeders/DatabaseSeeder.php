<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            PaymentMethodSeeder::class,
//            CustomerSeeder::class,
//            RestaurantSeeder::class,
//            DeliveryAgentSeeder::class,
//            MenuSeeder::class,
//            OrderSeeder::class,
//            OrderItemSeeder::class,
        ]);
    }
}
