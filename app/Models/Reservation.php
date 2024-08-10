<?php

namespace App\Models;

use App\Traits\ReservationCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory, ReservationCode;

    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            $reservation->uuid = \Illuminate\Support\Str::uuid();
            $reservation->code = (new self)->create_code();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function eventPrice()
    {
        return $this->belongsTo(EventPrice::class);
    }
}
