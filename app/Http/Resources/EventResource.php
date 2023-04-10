<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Event $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'title' => $resource->title,
            'description' => $resource->description,
            'deadline' => $resource->deadline,
            'location' => $resource->location,
            'price' => $resource->price,
            'attendee_limit' => $resource->attendee_limit,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
