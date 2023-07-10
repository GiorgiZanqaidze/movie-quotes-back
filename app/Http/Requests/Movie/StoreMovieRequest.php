<?php

namespace App\Http\Requests\Movie;

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
			'title_en'           => 'required|min:3|regex:/^[a-zA-Z\s]+$/u|unique:movies,title->en',
			'title_ka'           => 'required|unique:movies,title->ka',
			'director_en'        => 'required|regex:/^[a-zA-Z\s]+$/u',
			'director_ka'        => 'required',
			'description_en'     => 'required|regex:/^[a-zA-Z\s]+$/u',
			'description_ka'     => 'required',
			'year'               => 'required|integer',
			'image'              => 'required|image',
			'user_id'            => 'required|exists:users,id',
			'genres'             => 'required',
		];

		return $rules;
	}
}
