<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->isMethod('patch')) {
            $rules = [
                'first_name' => 'sometimes|required|min:2',
                'last_name' => 'sometimes|required|min:2',
                'email' => 'sometimes|required|email|unique:users,email,' . $this->route('user'),
                'phone' => 'sometimes|required|regex:/^\+\d{7,}$/',
                'password' => 'sometimes|required',
            ];
        } elseif ($this->isMethod('put')) {
            $rules = [
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
                'email' => 'required|email|unique:users,email,' . $this->route('user'),
                'phone' => 'required|regex:/^\+\d{7,}$/',
                'password' => 'sometimes|required',
            ];
        }
        return $rules;
    }
}
