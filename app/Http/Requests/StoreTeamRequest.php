<?php

namespace App\Http\Requests;

use App\Team;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTeamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_create');
    }

    public function rules()
    {
        return [
            'nama'  => [
                'string',
                'required',
                'unique:teams',
            ],
            'email' => [
                'required',
            ],
        ];
    }
}
