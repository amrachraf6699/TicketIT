<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventsResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::active()->get();

        return $this->ok(200, 'Events fetched successfully',
        [
            'count' => $events->count(),
            'events' => EventsResource::collection($events)
        ]);
    }


    public function show(Event $event)
    {
        $event->load('planner.user', 'prices');

        return $this->ok(200, 'Event fetched successfully', new EventsResource($event));
    }
}
