<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpeakerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return
        [
            'able_to_join_events' => $this->when($this->speaker->ticket_id, true, false),
            'access_ID' => $this->when($this->speaker->ticket_id, url($this->speaker->ticket_id)),
            'id' => $this->uuid,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => url($this->avatar),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'job_title' => $this->speaker->job_title,
            'bio' => $this->speaker->bio,
            'company' =>
            [
                'id' => $this->speaker->company->user->uuid,
                'name' => $this->speaker->company->user->name,
                'username' => $this->speaker->company->user->username,
                'email' => $this->speaker->company->user->email,
                'avatar' => url($this->speaker->company->user->avatar),
            ]
        ];
    }
}
