<?php

namespace App\Http\Requests\Movie;

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
			'title_en'           => 'required|regex:/^[a-zA-Z\s]+$/u',
			'title_ka'           => 'required',
			'director_en'        => 'required|regex:/^[a-zA-Z\s]+$/u',
			'director_ka'        => 'required',
			'description_en'     => 'required|regex:/^[a-zA-Z\s]+$/u',
			'description_ka'     => 'required',
			'year'               => 'required|integer',
			'user_id'            => 'exists:users,id',
			'genres'             => 'required',
		];

		return $rules;
	}
}
