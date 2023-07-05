<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeBasicResources extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'         => $this->id,
			'author'     => new UserBasicResources($this->whenLoaded('author')),
			'quote'      => new QuoteBasicResources($this->whenLoaded('quote')),
		];
	}
}
