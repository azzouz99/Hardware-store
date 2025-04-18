<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_product')) {
            Schema::create('order_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained();
                $table->integer('quantity');
                $table->decimal('price_at_time', 10, 2);
                $table->decimal('promotion_price_at_time', 10, 2)->nullable();
                $table->decimal('subtotal', 10, 2);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('order_items')) {
            Schema::dropIfExists('order_items');
        }
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};