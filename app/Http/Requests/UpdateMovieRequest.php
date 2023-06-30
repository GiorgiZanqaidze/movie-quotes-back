<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'title_en'           => '|min:3|max:255',
			'title_ka'           => '|min:3|max:255',
			'director_en'        => 'min:3',
			'director_ka'        => 'min:3',
			'description_en'     => 'min:3',
			'description_ka'     => 'min:3',
			'year'               => '|integer',
			'user_id'            => '|exists:users,id',
			'genres'             => '',
		];

		return $rules;
	}
}
