<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
			'name'                  => 'required|min:3|max:15|regex:/^[a-z0-9]+$/',
			'email'                 => 'required|email|max:255|unique:users,email',
			'password'              => 'required|confirmed|min:8|max:15|regex:/^[a-z0-9]+$/',
		];

		return $rules;
	}

	protected function prepareForValidation()
	{
		$token = Str::random(64);
		$this->merge([
			'remember_token' => $token,
		]);
	}

	public function messages()
	{
		return [
			'name.regex'     => 'The name must only contain lower case letters and numbers.',
			'password.regex' => 'The password must only contain lower case letters and numbers.',
		];
	}
}
