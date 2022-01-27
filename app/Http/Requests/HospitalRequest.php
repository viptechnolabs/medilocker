<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'details' => 'required',
            'register_no' => 'required|max:13',
            'fex_no' => 'required|max:13',
            'pin_code' => 'required|max:10',
            'address' => 'required',
            'logo' => 'mimes:jpeg,png,jpg,svg',
        ];
    }
}
