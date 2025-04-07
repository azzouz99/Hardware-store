<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unite');         // Unit as a string (e.g., "kg", "piece", etc.)
            $table->string('reference');     // Reference code
            $table->json('images')->nullable(); // Multiple images stored as JSON (an array of image paths)
            $table->integer('quantity')->default(0);
            // Status as an enum (can be 'Disponible' or 'sur commande')
            $table->enum('status', ['Disponible', 'sur commande'])->default('Disponible');
            // Promotion flag (true if the product is on promotion)
            $table->boolean('promotion')->default(false);
            $table->integer('promotion_value')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
