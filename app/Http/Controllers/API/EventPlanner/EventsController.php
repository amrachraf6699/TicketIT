<?php

namespace App\Http\Controllers\API\EventPlanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventPlanner\CreateEventPriceRequest;
use App\Http\Requests\EventPlanner\CreateEventRequest;
use App\Http\Resources\EventPlanner\EventsResource;
use App\Models\Event;
use App\Models\EventPrice;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventsController extends Controller
{
    use JsonResponse;

    public function index(Request $request)
    {
        $user = $request->user();
        $user = $user->load(['eventPlanner.events']);

        return $this->ok(200, 'Here are your events', EventsResource::collection($user->eventPlanner->events));
    }

    public function store(CreateEventRequest $request)
    {
        $event = $request->user()->eventPlanner->events()->create($request->validated());

        return $this->ok(201, 'Event created successfully', new EventsResource($event));
    }

    public function show(Request $request, Event $event)
    {
        $event = $event->load('prices');

        return $this->ok(200, 'Here is the event', new EventsResource($event));
    }

    public function storePrice(CreateEventPriceRequest $request, Event $event)
    {
        Gate::authorize('create', [EventPrice::class, $event]);

        $request['privileges'] = json_encode($request['privileges']);

        $event->prices()->create($request->toArray());

        return $this->ok(201, 'Price created successfully', new EventsResource($event));
    }
}
