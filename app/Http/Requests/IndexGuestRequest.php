<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexGuestRequest extends CommonRequest
{
    public function rules()
    {
        return [
            'limit' => 'integer|min:1|max:100',
            'offset' => 'integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'integer' => 'The :attribute must be an integer',
            'min' => 'The :attribute must be at least :min',
            'max' => 'The :attribute may not be greater than :max',
        ];
    }
}
