<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_line', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_order_id');
            $table->unsignedInteger('product_item_id');
            $table->decimal('price', 10, 2);
            $table->string('SKU')->unique();

            $table->timestamps();


            $table->foreign('shop_order_id')->references('id')->on('shop_order')->onDelete('cascade');
            $table->foreign('product_item_id')->references('id')->on('product_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_line');
    }
}
