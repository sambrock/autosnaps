<?php

namespace App\Listeners;

use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class DeleteUploads
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        if ($event->deleteImages) {
            $images = Upload::where('car_id', $event->car->id)->get();
            $images->each(function ($image) {
                Storage::disk('s3')->delete('uploads/' . $image->filename);
            });

            Upload::where('car_id', $event->car->id)->delete();
        }

        unset($event->car->imagesAdded);
    }
}
