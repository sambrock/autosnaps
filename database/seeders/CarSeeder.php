<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Place;
use App\Models\Upload;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run()
    {
        Car::factory()
            ->times(env('CAR_SEEDER'))
            ->has(Upload::factory()->count(3), 'uploads')
            ->create();
    }
}
