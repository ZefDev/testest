<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^\+\d{7,}$/',
            'password' => 'required',
            'role' => 'required|exists:roles,name',
        ];
    }
}
