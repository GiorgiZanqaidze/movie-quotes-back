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
			'author'           => new UserResource($this->whenLoaded('author')),
			'quotes'           => QuoteResource::collection($this->whenLoaded('quotes')),
			'genres'           => GenreResource::collection($this->whenLoaded('genres')),
		];
	}
}
