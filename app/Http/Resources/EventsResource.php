<?php

namespace App\Http\Resources;

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
            'description' => $this->description,
            'banner' => url($this->banner),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'location' => $this->location,
            'google_map_url' => $this->google_map_url,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'planner' =>
            [
                'id' => $this->planner->user->uuid,
                'name' => $this->planner->user->name,
                'email' => $this->when($request->routeIs('event.show'), $this->planner->user->email),
                'phone' => $this->when($request->routeIs('event.show'), $this->planner->user->phone),
                'avatar' => url($this->planner->user->avatar),
            ],
            'prices' => $this->when($request->routeIs('event.show'), EventPricesResource::collection($this->prices)),
        ];
    }
}
