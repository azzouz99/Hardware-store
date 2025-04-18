<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First create categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Then create subcategories that depend on categories
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Then create subsubcategories that depend on subcategories
        Schema::create('subsubcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Then create products table with subsubcategory relationship
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unite');
            $table->string('reference');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', ['Disponible', 'sur commande'])->default('Disponible');
            $table->boolean('promotion')->default(false);
            $table->decimal('promotion_price', 10, 2)->nullable();
            $table->foreignId('subsub_category_id')->nullable()->constrained('subsubcategories')->onDelete('set null');
            $table->timestamps();
        });

        // Then create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('government');
            $table->text('address');
            $table->text('note')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending');
            $table->timestamps();
        });

        // Finally create order_items table that depends on both products and orders
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained();
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->decimal('promotion_price', 10, 2)->nullable();
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop tables in reverse order of creation
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('subsubcategories');
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
    }
};
