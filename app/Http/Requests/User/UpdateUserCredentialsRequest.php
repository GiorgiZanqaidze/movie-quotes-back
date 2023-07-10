<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserCredentialsRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [];

		$rules['name'] = 'required|min:3|regex:/^[a-z0-9]+$/';

		$rules['email'] = 'required|email';

		if (!$this->filled('password')) {
			$rules['password'] = '';
		} else {
			$rules['password'] = 'required|confirmed|min:8|max:15|regex:/^[a-z0-9]+$/';
		}

		return $rules;
	}
}
