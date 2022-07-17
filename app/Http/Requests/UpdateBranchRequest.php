<?php

namespace App\Http\Requests;

use App\Models\Branch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBranchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('branch_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'bays_jacks' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'booking_capability' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
