<?php

namespace App\Http\Requests;

use App\Pengukuran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPengukuranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pengukuran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pengukurans,id',
        ];
    }
}
