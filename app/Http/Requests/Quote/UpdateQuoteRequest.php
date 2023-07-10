<?php

namespace App\Http\Requests\Quote;

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
			'name_en'           => 'required|regex:/^[a-zA-Z\s]+$/u',
			'name_ka'           => 'required',
		];

		return $rules;
	}
}
