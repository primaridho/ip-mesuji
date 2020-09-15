<?php

namespace App\Http\Requests;

use App\Jodesk;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJodeskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jodesk_create');
    }

    public function rules()
    {
        return [
            'nama_jodesk' => [
                'string',
                'required',
            ],
            'deskripsi'   => [
                'string',
                'required',
            ],
            'petugas.*'   => [
                'integer',
            ],
            'petugas'     => [
                'array',
            ],
        ];
    }
}
