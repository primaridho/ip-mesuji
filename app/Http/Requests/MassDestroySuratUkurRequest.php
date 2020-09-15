<?php

namespace App\Http\Requests;

use App\SuratUkur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySuratUkurRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('surat_ukur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:surat_ukurs,id',
        ];
    }
}
