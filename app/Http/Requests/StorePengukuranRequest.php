<?php

namespace App\Http\Requests;

use App\Pengukuran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePengukuranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pengukuran_create');
    }

    public function rules()
    {
        return [
            'id_berkas_id'       => [
                'required',
                'integer',
            ],
            'pembantu_ukurs.*'   => [
                'integer',
            ],
            'pembantu_ukurs'     => [
                'required',
                'array',
            ],
            'desa_id'            => [
                'required',
                'integer',
            ],
            'kecamatan_id'       => [
                'required',
                'integer',
            ],
            'no_gu'              => [
                'string',
                'required',
                'unique:pengukurans',
            ],
            'no_su_baru'         => [
                'string',
                'nullable',
            ],
            'tanggal_pengukuran' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
