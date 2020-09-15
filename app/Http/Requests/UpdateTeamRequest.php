<?php

namespace App\Http\Requests;

use App\Team;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTeamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('team_edit');
    }

    public function rules()
    {
        return [
            'nama'  => [
                'string',
                'required',
                'unique:teams,nama,' . request()->route('team')->id,
            ],
            'email' => [
                'required',
            ],
        ];
    }
}
