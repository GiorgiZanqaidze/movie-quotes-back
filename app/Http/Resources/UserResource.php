<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id'                     => $this->id,
			'name'                   => $this->name,
			'email'                  => $this->email,
			'image'                  => $this->image,
			'movies'                 => MovieResource::collection($this->whenLoaded('movies')),
			'quotes'                 => QuoteBasicResources::collection($this->whenLoaded('quotes')),
			'sent_notifications'     => NotificationResource::collection($this->whenLoaded('sentNotifications')),
			'received_notifications' => NotificationResource::collection($this->whenLoaded('receivedNotifications')),
		];
	}
}
