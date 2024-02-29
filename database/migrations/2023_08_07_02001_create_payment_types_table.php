<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTypesTable extends Migration
{
    
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
           $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('product_image')->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('payment_type');
    }
}
