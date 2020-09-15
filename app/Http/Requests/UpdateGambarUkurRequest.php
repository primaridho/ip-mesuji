<?php

namespace App\Http\Requests;

use App\GambarUkur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGambarUkurRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gambar_ukur_edit');
    }

    public function rules()
    {
        return [
            'id_pengukuran_id' => [
                'required',
                'integer',
            ],
            'id_kecamatan_id'  => [
                'required',
                'integer',
            ],
            'id_desa_id'       => [
                'required',
                'integer',
            ],
        ];
    }
}
