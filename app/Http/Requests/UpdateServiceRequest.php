<?php

namespace App\Http\Requests;

use App\Models\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_edit');
    }

    public function rules()
    {
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
                'string',
                'required',
            ],
            'mileage' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'working_time' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
