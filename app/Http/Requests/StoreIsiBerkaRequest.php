<?php

namespace App\Http\Requests;

use App\IsiBerka;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIsiBerkaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('isi_berka_create');
    }

    public function rules()
    {
        return [
            'nama_isi' => [
                'string',
                'required',
            ],
        ];
    }
}
