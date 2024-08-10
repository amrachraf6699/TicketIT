<?php

namespace App\Models;

use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPlannerRequest extends Model
{
    use HasFactory, UploadImage;

    protected $guarded = [];

    const STATUSES = ['pending', 'approved', 'rejected'];
    const DEFAULT_STATUS = 'pending';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = \Illuminate\Support\Str::uuid();
        });
    }


    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = $this->uploadImage('public_path', $value, 'images/request-to-join');
    }

    public function getAvatarAttribute($value)
    {
        return url($value);
    }


    public function notes()
    {
        return $this->hasMany(EventPlannerRequestNote::class);
    }
}
