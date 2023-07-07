<?php

namespace App\Http\Requests\Like;

use Illuminate\Foundation\Http\FormRequest;

class StoreLikeRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'user_id'     => 'required',
			'quote_id'    => 'required|unique:likes,quote_id,NULL,id,user_id,' . auth()->id(),
			'receiver_id' => 'required',
		];

		return $rules;
	}
}
