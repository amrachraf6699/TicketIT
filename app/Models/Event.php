<?php

namespace App\Models;

use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, UploadImage;

    protected $guarded = [];

    const STATUSES = ['pending', 'approved', 'rejected'];
    const STATUS_PENDING = 'pending';


    public function scopeActive($query)
    {
        return $query->where('status', 'approved')->where('start_date', '>=', now());
    }

    public function planner()
    {
        return $this->belongsTo(EventPlanner::class, 'event_planner_id');
    }





    public function prices()
    {
        return $this->hasMany(EventPrice::class);
    }


    protected static function booted()
    {
        parent::booted();

        static::creating(function ($reservation) {
            $reservation->uuid = \Illuminate\Support\Str::uuid();
        });
    }

    public function setBannerAttribute($value)
    {
        $this->attributes['banner'] = $this->uploadImage('public_path', $value, 'images/events');
    }
}
