<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->dateTime('order_date');
            $table->unsignedInteger('payment_method_id');
            $table->unsignedInteger('shipping_address_id');
            $table->unsignedInteger('shipping_method_id');
            $table->decimal('order_total', 10, 2);
            $table->string('SKU')->unique();
            $table->unsignedInteger('order_status_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('user_payment_method')->onDelete('cascade');
            $table->foreign('shipping_address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('order_status_id')->references('id')->on('order_status')->onDelete('cascade');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_method')->onDelete('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_order');
    }
}
