<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPaymentMethodsTable extends Migration
{
    
    public function up()
    {
        Schema::create('user_payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('payment_type_id');
            $table->string('provider');
            $table->string('account_number');
            $table->string('expiry_date');
            $table->boolean('is_default')->default(false);
            $table->string('product_image')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('user_payment_method');
    }
}
