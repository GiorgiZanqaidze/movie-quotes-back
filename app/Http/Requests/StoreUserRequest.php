<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'username'              => 'required|min:3|max:15|regex:/^[a-z0-9]+$/',
            'email'                 => 'required|email|max:255|unique:users,email',
            'password'              => 'required|confirmed|min:3',
        ];

        return $rules;
    }



}
