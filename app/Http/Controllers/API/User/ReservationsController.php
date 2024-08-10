<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Resources\ReservationsResource;
use App\Models\Reservation;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReservationsController extends Controller
{
    use JsonResponse;


    public function index(Request $request)
    {
        $user = auth()->user();

        $reservations = $user->reservations()
            ->with([
                'eventPrice',
                'eventPrice.event',
            ])
            ->get();

        return $this->ok(200, 'Reservations fetched successfully', ReservationsResource::collection($reservations));
    }

    public function store(CreateReservationRequest $request)
    {
        $user = auth()->user();

        $reservation = $user->reservations()->create($request->validated());


        return $this->ok(200,
            'Your reservation has been created successfully',
            [
                'id' => $reservation->uuid,
                'code' => $reservation->code,
            ]
        );
    }

    public function show(Reservation $reservation)
    {
        Gate::authorize('view',$reservation);

        $reservation->load([
            'eventPrice',
            'eventPrice.event',
            'eventPrice.event.planner.user',
        ]);

        return $this->ok(200, 'Reservation for '. $reservation->eventPrice->event->title . ' fetched successfully', new ReservationsResource($reservation));
    }



}
