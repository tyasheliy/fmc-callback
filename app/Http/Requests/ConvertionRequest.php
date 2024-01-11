<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConvertionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from' => 'max:3|required',
            'value' => 'numeric',
            'to' => 'max:3|required',
            'date' => 'date_format:d-m-Y'
        ];
    }
}
