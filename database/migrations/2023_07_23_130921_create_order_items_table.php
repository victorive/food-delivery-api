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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('restaurant_id')->constrained('restaurants');
            $table->foreignId('menu_id')->constrained('menus');
            $table->integer('quantity');
            $table->decimal('amount', 14, 2);
            $table->tinyInteger('confirmation_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
