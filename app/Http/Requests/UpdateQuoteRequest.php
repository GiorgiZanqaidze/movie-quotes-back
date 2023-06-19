<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuoteRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'name_en'           => 'required|min:3|max:255',
			'name_ka'           => 'required|min:3|max:255',
			'movie_id'          => 'required|exists:movies,id',
			'user_id'           => 'required|exists:users,id',
		];

		return $rules;
	}
}
