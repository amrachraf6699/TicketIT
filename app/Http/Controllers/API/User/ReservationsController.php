<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Resources\ReservationsResource;
use App\Jobs\ReservationJob;
use App\Models\EventPrice;
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
        Gate::authorize('create', [Reservation::class, $request->event_price_id]);

        $available_seats = EventPrice::where('id', $request->event_price_id)->value('quantity');

        if ($available_seats == 0) {
            return $this->error(400, 'Sorry, there are no available seats for this event');
        }

        $user = auth()->user();
        $event_price_id = $request->event_price_id;

        ReservationJob::dispatch($event_price_id,$user);

        return $this->ok(201,
            'Your reservation has been created successfully . Please check your email or notifications for more details',
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
