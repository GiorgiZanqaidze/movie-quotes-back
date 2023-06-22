<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'title_en'           => 'required|min:3|max:255',
			'title_ka'           => 'required|min:3|max:255',
			'director_en'        => 'required',
			'director_ka'        => 'required',
			'description_en'     => 'required',
			'description_ka'     => 'required',
			'year'               => 'required|integer',
			'image'              => 'required|image',
			'user_id'            => 'required|exists:users,id',
			'genres'             => 'required',
		];

		return $rules;
	}
}
