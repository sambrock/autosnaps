<?php

use Database\Seeders\CarMakeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarMakesTable extends Migration
{
    public function up()
    {
        Schema::create('car_makes', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code');

            $table->timestamps();
        });

        // Seed this table (required in production)
        $seeder = new CarMakeSeeder();
        $seeder->run();
    }

    public function down()
    {
        Schema::dropIfExists('car_makes');
    }
}
