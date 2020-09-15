<?php

namespace App\Http\Requests;

use App\BerkasMasuk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBerkasMasukRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('berkas_masuk_edit');
    }

    public function rules()
    {
        return [
            'tgl_masuk'         => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'petugas_loket'     => [
                'string',
                'required',
            ],
            'penerima_masuk_id' => [
                'required',
                'integer',
            ],
            'no_berkas'         => [
                'string',
                'required',
            ],
            'nama_pemohon'      => [
                'string',
                'required',
            ],
            'desa_id'           => [
                'required',
                'integer',
            ],
            'kecamatan_id'      => [
                'required',
                'integer',
            ],
            'jenis_kegiatan'    => [
                'required',
            ],
            'no_surattugas'     => [
                'string',
                'required',
                'unique:berkas_masuks,no_surattugas,' . request()->route('berkas_masuk')->id,
            ],
            'tgl_surattugas'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'no_su'             => [
                'string',
                'nullable',
            ],
            'no_hak'            => [
                'string',
                'nullable',
            ],
            'isiberkas.*'       => [
                'integer',
            ],
            'isiberkas'         => [
                'required',
                'array',
            ],
        ];
    }
}
