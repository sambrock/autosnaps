<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCar extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'model_id' => 'required',
            'location' => 'required|max:255',
            'images' => 'required|accepted',
            'description' => 'max:1000',
            'place_id' => 'required|max:255',
        ];
    }
}
