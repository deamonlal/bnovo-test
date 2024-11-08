<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestRequest extends CommonRequest
{
    public function rules()
    {
        return [
            'name' => 'string',
            'surname' => 'string',
            'email' => 'email|unique:guests',
            'phone' => 'phone|unique:guests',
            'country' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'string' => 'The :attribute must be a string',
            'email' => 'The :attribute must be a valid address',
            'unique' => 'The :attribute already exists',
        ];
    }
}
