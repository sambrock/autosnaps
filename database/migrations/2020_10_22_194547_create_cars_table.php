<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();

            $table->string('location');
            $table->float('lng');
            $table->float('lat');
            $table->text('description')->nullable();

            $table->string('place_id');

            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('car_models');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
