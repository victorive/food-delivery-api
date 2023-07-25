<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('delivery_agent_id')->nullable()->constrained('delivery_agents');
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->foreignId('payment_method_id')->default(1)->constrained('payment_methods');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
