<?php

namespace App\Http\Requests\Quote;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequest extends FormRequest
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
			'image'             => 'required|image',
			'movie_id'          => 'required|exists:movies,id',
			'user_id'           => 'required|exists:users,id',
		];

		return $rules;
	}
}
