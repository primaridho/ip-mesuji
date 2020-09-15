<?php

namespace App\Http\Requests;

use App\BerkasKeluar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBerkasKeluarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('berkas_keluar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:berkas_keluars,id',
        ];
    }
}
