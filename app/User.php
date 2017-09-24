<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function event()
    {
          return $this->hasMany(Event::class);
    }

    public function publishEvent($event)
    {
          return $this->event()->create($event);
    }
    public function updateEvent($event)
    {
          return $this->event()->update($event);
    }





}
