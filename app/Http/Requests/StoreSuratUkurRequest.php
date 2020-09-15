<?php

namespace App\Http\Requests;

use App\SuratUkur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSuratUkurRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('surat_ukur_create');
    }

    public function rules()
    {
        return [
            'id_kecamatan_id' => [
                'required',
                'integer',
            ],
            'id_desa_id'      => [
                'required',
                'integer',
            ],
            'no_su'           => [
                'string',
                'min:5',
                'max:11',
                'required',
            ],
            'tahun'           => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'gambar'          => [
                'required',
            ],
        ];
    }
}
