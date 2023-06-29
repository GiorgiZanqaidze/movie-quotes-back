<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	public function rules(): array
	{
		$rules = [
			'name'                  => 'min:3|max:15|regex:/^[a-z0-9]+$/',
			'email'                 => 'email|max:255|unique:users,email',
			'password'              => 'confirmed|min:8|max:15|regex:/^[a-z0-9]+$/',
		];

		return $rules;
	}
}
