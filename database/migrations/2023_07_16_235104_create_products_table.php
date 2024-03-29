<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->string('product_image')->nullable();
            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
