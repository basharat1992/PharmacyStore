<?php

namespace App\Http\Requests;

use App\Recruitment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRecruitmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('recruitment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'  => [
                'required',
            ],
            'email' => [
                'required',
            ],
        ];
    }
}
