<?php

namespace App\Http\Requests;

use App\Models\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_create');
    }

    public function rules()
    {

        dd($_REQUEST);
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'last_appointment' => [
                'required',
            ],
            'branches.*' => [
                'integer',
            ],
            'branches' => [
                'required',
                'array',
            ],
            'brands.*' => [
                'integer',
            ],
            'brands' => [
                'required',
            ],
            'model_year' => [
                'array',
                'required',
            ],
            'mileage' => [
                'required',
                // 'integer',
                'array',
                'min:-2147483648',
                'max:2147483647',
            ],
            'working_time' => [
                'required',
                // 'integer',
                'array',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price' => [
                'required',
                // 'integer',
                'array',
                'min:-2147483648',
                'max:2147483647',
            ],
            // 'brand_meta' => [
            //     'required',
            // ],
            
        ];
    }
}
