<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
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
            'message' => $this->data['message'],
            'details' => $this->when($request->routeIs('notification.read'), $this->data['details']),
            'file' => $this->when($request->routeIs('notification.read'), $this->data['file']),
            'sent_at' => $this->created_at->format('Y-m-d H:i:s'),
            'read_at' => $this->read_at ? $this->read_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
