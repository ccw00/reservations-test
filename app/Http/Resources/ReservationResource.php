<?php

namespace App\Http\Resources;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Reservation $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'event' => EventResource::make($this->whenLoaded('event')),
        ];
    }
}
