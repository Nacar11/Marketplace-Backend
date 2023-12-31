<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_item_id');
            $table->unsignedInteger('variation_option_id');
            $table->foreign('product_item_id')->references('id')->on('product_items')->onDelete('cascade');
            $table->foreign('variation_option_id')->references('id')->on('variation_options');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_configurations');
    }
}
