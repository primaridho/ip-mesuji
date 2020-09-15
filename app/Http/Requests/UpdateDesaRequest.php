<?php

namespace App\Http\Requests;

use App\Desa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDesaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('desa_edit');
    }

    public function rules()
    {
        return [
            'id_kecamatan_id' => [
                'required',
                'integer',
            ],
            'kode_desa'       => [
                'string',
                'required',
            ],
            'nama_desa'       => [
                'string',
                'required',
            ],
        ];
    }
}
