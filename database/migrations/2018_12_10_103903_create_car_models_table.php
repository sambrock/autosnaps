<?php

use Database\Seeders\CarModelSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarModelsTable extends Migration
{
    public function up()
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('make_id')->unsigned()->index();
            $table->string('code');
            $table->string('name');

            $table->timestamps();

            $table->foreign('make_id')->references('id')->on('car_makes');
        });

        // Seed this table (required in production)
        $seeder = new CarModelSeeder();
        $seeder->run();
    }

    public function down()
    {
        Schema::dropIfExists('car_models');
    }
}
