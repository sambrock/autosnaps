<?php

namespace Database\Seeders;

use App\Models\Upload;
use Illuminate\Database\Seeder;

class UploadSeeder extends Seeder
{
    public function run()
    {
        Upload::factory()->times(env('CAR_SEEDER') * 4)->create();
    }
}
