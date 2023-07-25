<?php

namespace Database\Seeders;

use App\Models\DeliveryAgent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryAgent::factory()->count(10)->create();
    }
}
