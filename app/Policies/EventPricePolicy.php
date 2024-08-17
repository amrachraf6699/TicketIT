<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\EventPrice;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPricePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EventPrice $eventPrice): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user ,Event $event): bool
    {
        return $user->role === 'event_planner' && $event->event_planner_id === $user->eventPlanner->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EventPrice $eventPrice): bool
    {
        return auth('sanctum')->user()->role === 'event_planner' && $eventPrice->event->event_planner_id === auth('sanctum')->id();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EventPrice $eventPrice): bool
    {
        return auth('sanctum')->user()->role === 'event_planner' && $eventPrice->event->event_planner_id === auth('sanctum')->id();
    }
}
