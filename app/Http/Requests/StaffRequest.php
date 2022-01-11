<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->request->get('id');
        return [
            'name' => 'required',
            'email' => 'email|max:50|unique:users,email,' . $id,
            'mobile_no' => 'required|max:13|min:7',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin_code' => 'required|max:10',
            'aadhaar_no' => 'required|max:12|min:12|unique:users,aadhaar_no,' . $id,
            'role' => 'required',
            'gender' => [Rule::requiredIf(empty($id))],
            'dob' => 'required',
            'avatar' => ['mimes:jpeg,png,jpg,svg', Rule::requiredIf(empty($id))],
            'document_pic' => ['mimes:jpeg,png,jpg,svg', Rule::requiredIf(empty($id))],
        ];
    }
}
