<?php

namespace App;

use App\Product;
use App\MyTraits\Eventable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Eventable;

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

    public function products()
    {
          return $this->hasMany(Product::class);
    }

    public function createProduct($data)
    {
          return $this->products()->create($data);
    }

    public function updateProduct($data)
    {
          return $this->products()->update($data);
    }




}
