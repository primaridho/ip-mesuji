<?php

namespace App\Http\Requests;

use App\Petum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePetumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('petum_edit');
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
            'no_peta'         => [
                'string',
                'required',
            ],
            'no_lembar'       => [
                'string',
                'required',
            ],
            'tahun'           => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status_peta'     => [
                'required',
            ],
            'keterangan'      => [
                'required',
            ],
        ];
    }
}
