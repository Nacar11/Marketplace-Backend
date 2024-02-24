<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('product_item_id');
            $table->boolean('selectedToCheckout')->default(false); // Added column
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('shopping_carts');
            $table->foreign('product_item_id')->references('id')->on('product_items');

            $table->unique(['cart_id', 'product_item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('shopping_cart_items');
    }
}
