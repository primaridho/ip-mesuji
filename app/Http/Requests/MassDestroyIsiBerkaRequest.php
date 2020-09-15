<?php

namespace App\Http\Requests;

use App\IsiBerka;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIsiBerkaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('isi_berka_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:isi_berkas,id',
        ];
    }
}
