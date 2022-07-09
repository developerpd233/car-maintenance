<?php

namespace App\Http\Requests;

use App\Models\Subscribtion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubscribtionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subscribtion_create');
    }

    public function rules()
    {
        return [
            'users.*' => [
                'integer',
            ],
            'users' => [
                'required',
                'array',
            ],
            'transactions.*' => [
                'integer',
            ],
            'transactions' => [
                'required',
                'array',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
