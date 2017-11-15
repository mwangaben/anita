<?php

namespace App;

use App\Product;
use App\Challenge;
use App\MyTraits\Eventable;
use App\MyTraits\Productive;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Eventable, Productive;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin()
    {
          return  $this->role == 'admin';
    }

    public function challenges()
    {
          return $this->hasMany(Challenge::class);
    }

    public function createChallenge($data)
    {
          return $this->challenges()->create($data);
    }

    public function updateChallenge($data)
    {
         return  $this->challenges()->update($data);
    }


    public function abouts()
    {
          return $this->hasOne(About::class);
    }

    public function updateAbout($data)
    {
          return $this->abouts()->update($data);
    }




}
