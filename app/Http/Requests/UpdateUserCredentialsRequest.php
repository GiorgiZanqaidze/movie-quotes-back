<?php

namespace App\Http\Requests;

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
		$rules = [
			'name'                  => 'min:3|regex:/^[a-z0-9]+$/',
			'email'                 => 'email',
			'password'              => 'confirmed|min:8|max:15|regex:/^[a-z0-9]+$/',
		];

		return $rules;
	}
}
