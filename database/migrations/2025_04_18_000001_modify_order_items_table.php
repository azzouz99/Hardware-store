<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('product_name');
            $table->decimal('price_at_time', 8, 2)->after('product_id');
            $table->decimal('promotion_price_at_time', 8, 2)->nullable()->after('price_at_time');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('product_name');
            $table->dropColumn(['price_at_time', 'promotion_price_at_time']);
        });
    }
};