<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar' => $this->when($this->avatar !== null , url($this->avatar) , url('images/default-avatar.png')),
            'joined_at' => $this->created_at->format('Y-m-d H:i:s'),
            'last_updated_at' => $this->when($this->updated_at != $this->created_at ,
                $this->updated_at->format('Y-m-d H:i:s') ,
                'Never Updated'
            ),
        ];
    }
}
