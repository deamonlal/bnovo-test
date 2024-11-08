<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestRequest extends CommonRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'email|unique:guests',
            'phone' => 'required|phone|unique:guests',
            'country' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is a required field',
            'string' => 'The :attribute must be a string',
            'email' => 'The :attribute must be a valid address',
            'phone' => 'The :attribute field must be a valid number',
            'unique' => 'The :attribute already exists',
        ];
    }
}
