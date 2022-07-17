<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBrandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('brand_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:1',
                'max:100',
                'required',
            ],
            'image' => [
<<<<<<< HEAD
                'nullable',
=======
                'required',
>>>>>>> d0b1ee2421818d6b8739f224256661952cb06fb4
            ],
        ];
    }
}
