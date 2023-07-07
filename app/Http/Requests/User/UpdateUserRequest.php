<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'email' => 'required|exists:users,email',
		];

		return $rules;
	}

	public function messages()
	{
		return [
			'email.exists'   => json_encode([
				'en' => 'The mail is not registered',
				'ka' => 'ელ. ფოსტა არ არსებობს.',
			]),
		];
	}
}
