<?php

namespace App\Http\Requests;

use App\GambarUkur;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGambarUkurRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('gambar_ukur_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:gambar_ukurs,id',
        ];
    }
}
