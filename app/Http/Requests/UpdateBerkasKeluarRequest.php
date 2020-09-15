<?php

namespace App\Http\Requests;

use App\BerkasKeluar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBerkasKeluarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('berkas_keluar_edit');
    }

    public function rules()
    {
        return [
            'berkasmasuk_id'      => [
                'required',
                'integer',
            ],
            'tgl_keluar'          => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'penerima_keluar'     => [
                'string',
                'required',
            ],
            'pemberi_keluar_id'   => [
                'required',
                'integer',
            ],
            'isiberkas_keluars.*' => [
                'integer',
            ],
            'isiberkas_keluars'   => [
                'required',
                'array',
            ],
        ];
    }
}
