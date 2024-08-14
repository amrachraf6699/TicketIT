<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\EventPrice;
use App\Models\Reservation;
use App\Notifications\ReservationNotification;
use App\Traits\GeneratePDF;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ReservationJob implements ShouldQueue
{
    use Queueable;

    use GeneratePDF;

    public $event_price_id , $user;

    /**
     * Create a new job instance.
     */
    public function __construct($event_price_id, $user)
    {
        $this->event_price_id = $event_price_id;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        EventPrice::where('id', $this->event_price_id)->decrement('quantity');
        EventPrice::where('id', $this->event_price_id)->increment('quantity_sold');
        $reservation = $this->user->reservations()->create([
            'event_price_id' => $this->event_price_id,
        ]);

        DB::commit();
        $pdf = $this->generatePDF($reservation);
        $this->user->notify(new ReservationNotification($reservation, $pdf));
    }
}
