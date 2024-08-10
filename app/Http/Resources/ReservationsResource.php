<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->uuid,
            'code' => $this->when($request->routeIs('reservation.show'),$this->code),
            'price' => number_format( $this->eventPrice->price, 2) . ' EGP',
            'ordered_at' => $this->created_at->format('Y-m-d H:i:s'),
            'event' => [
                'id' => $this->eventPrice->event->uuid,
                'title' => $this->eventPrice->event->title,
                'description' => $this->when($request->routeIs('reservation.show'),$this->eventPrice->event->description),
                'banner' => url($this->eventPrice->event->banner),
                'start_date' => $this->when($request->routeIs('reservation.show'),$this->eventPrice->event->start_date),
                'end_date' => $this->when($request->routeIs('reservation.show'),$this->eventPrice->event->end_date),
                'location' => $this->when($request->routeIs('reservation.show'),$this->eventPrice->event->location),
                'google_map_url' => $this->when($request->routeIs('reservation.show'),$this->eventPrice->event->google_map_url),
                'category' => $this->when($request->routeIs('reservation.show'),[
                    'title' => $this->eventPrice->title,
                    'privileges' => $this->eventPrice->privileges,
                ]),
                'event_planner' => $this->when($request->routeIs('reservation.show'),[
                    'id' => $this->eventPrice->event->planner->user->uuid,
                    'name' => $this->eventPrice->event->planner->user->name,
                    'email' => $this->eventPrice->event->planner->user->email,
                    'phone' => $this->eventPrice->event->planner->user->phone,
                    'avatar' => url($this->eventPrice->event->planner->user->avatar),

                ]),
            ],
        ];
    }
}
