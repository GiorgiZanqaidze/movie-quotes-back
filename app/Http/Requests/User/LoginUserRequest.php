<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'email'                  => 'required',
			'password'               => 'required',
			'device_name'            => 'required',
			'remember_me'            => 'boolean',
		];

		return $rules;
	}
}
