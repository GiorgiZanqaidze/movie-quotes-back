<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
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
