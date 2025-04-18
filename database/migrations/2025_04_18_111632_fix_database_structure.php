<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First, create categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Then subcategories
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Then subsubcategories
        Schema::create('subsubcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Then create products
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

        // Create images table
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->timestamps();
        });

        // Create pivot table for products and images
        Schema::create('image_product', function (Blueprint $table) {
            $table->foreignId('image_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->primary(['image_id', 'product_id']);
        });

        // Create orders table
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

        // Create order items table
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
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('image_product');
        Schema::dropIfExists('images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('subsubcategories');
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
    }
};
