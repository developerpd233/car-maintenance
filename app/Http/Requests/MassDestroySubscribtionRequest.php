<?php

namespace App\Http\Requests;

use App\Models\Subscribtion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySubscribtionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('subscribtion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:subscribtions,id',
        ];
    }
}
