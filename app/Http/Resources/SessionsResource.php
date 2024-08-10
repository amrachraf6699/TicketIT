<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'signed_in_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : 'Date Not Available',
            'expires_at' => $this->expires_at ? $this->expires_at->format('Y-m-d H:i:s') : 'Never Expires',
            'last_used_at' => $this->last_used_at ? $this->last_used_at->format('Y-m-d H:i:s') : 'Never Used',
        ];
    }
}
