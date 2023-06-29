<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'               => $this->id,
			'title'            => $this->getTranslations('title'),
			'director'         => $this->getTranslations('director'),
			'description'      => $this->getTranslations('description'),
			'year'             => $this->year,
			'image'            => $this->image,
			'author'           => $this->author,
			'quotes'           => $this->quotes,
			'genres'           => $this->genres,
		];
	}
}
