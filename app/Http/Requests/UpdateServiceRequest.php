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
            'name' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
            ],
            'address' => [
                'required',
            ],
            'type' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
        ];
    }
}
