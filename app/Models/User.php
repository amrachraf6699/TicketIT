<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, UploadImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = \Illuminate\Support\Str::uuid();
        });
    }

    public function setAvatarAttribute($value)
    {
        if ($this->exists && $this->attributes['avatar']) {
            $old_image = $this->attributes['avatar'];
        } else {
            $old_image = null;
        }

        $this->attributes['avatar'] = $this->uploadImage('public_path', $value, 'images/avatars', $old_image);
    }


    public function routeNotificationForVonage(Notification $notification)
    {
        return '2'.$this->phone;
    }


    /// Start Actors
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function eventPlanner()
    {
        return $this->hasOne(EventPlanner::class);
    }


    public function speaker()
    {
        return $this->hasOne(Speaker::class);
    }



    public function getRoleAttribute()
    {
        if ($this->admin) {
            return 'admin';
        } elseif ($this->eventPlanner) {
            return 'event_planner';
        } elseif ($this->speaker) {
            return 'speaker';
        } else {
            return 'user';
        }
    }



    //End Actors

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }



}
