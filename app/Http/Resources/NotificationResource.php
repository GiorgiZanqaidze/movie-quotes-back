<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
			'sender'     => new UserResource($this->whenLoaded('sender')),
			'receiver'   => new UserResource($this->whenLoaded('receiver')),
			'type'       => $this->type,
			'read_at'    => $this->read_at,
		];
	}
}
