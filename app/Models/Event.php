<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

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
}
