<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('car_id')->unsigned();

            $table->string('filename');
            $table->string('url');

            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
