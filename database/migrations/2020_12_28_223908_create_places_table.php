<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('car_id')->unsigned();
            $table->string('place_id');

            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    public function down()
    {
        Schema::dropIfExists('places');
    }
}
