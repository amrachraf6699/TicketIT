<?php

namespace App\Http\Resources\EventPlanner;

use App\Http\Resources\EventPricesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return
        [
            'id' => $this->uuid,
            'title' => $this->title,
            'banner' => url($this->banner),
            'description' => $this->when($request->routeIs('event.show'), $this->description),
            'start_date' => $this->when($request->routeIs('event.show'), $this->start_date),
            'end_date' => $this->when($request->routeIs('event.show'), $this->end_date),
            'google_map_url' => $this->when($request->routeIs('event.show'), $this->google_map_url),
            'location' => $this->when($request->routeIs('event.show'), $this->location),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'status' => $this->status,
            'prices' => EventPricesResource::collection($this->whenLoaded('prices')),
        ];
    }
}
