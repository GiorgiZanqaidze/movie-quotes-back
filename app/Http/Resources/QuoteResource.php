<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
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
			'name'       => $this->getTranslations('name'),
			'image'      => $this->image,
			'movie'      => new MovieResource($this->whenLoaded('movie')),
			'author'     => new UserBasicResources($this->whenLoaded('author')),
			'comments'   => CommentResource::collection(
				$this->whenLoaded('comments')->sortByDesc('created_at')
			),
			'likes'      => LikeResource::collection($this->whenLoaded('likes')),
		];
	}
}
