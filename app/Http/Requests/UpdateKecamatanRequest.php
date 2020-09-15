<?php

namespace App\Http\Requests;

use App\Kecamatan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKecamatanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kecamatan_edit');
    }

    public function rules()
    {
        return [
            'kode_kecamatan' => [
                'string',
                'required',
            ],
            'nama_kecamatan' => [
                'string',
                'required',
            ],
        ];
    }
}
