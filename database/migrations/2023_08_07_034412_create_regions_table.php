<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
   
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('country_id');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}