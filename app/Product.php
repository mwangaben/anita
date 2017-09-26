<?php

namespace App;

use App\User;
use App\Challenge;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function user()
    {
    	  return $this->belongsTo(User::class);
    }


    public function challenges()
    {
    	  return $this->belongsToMany(Challenge::class, 'challenge_product');
    }
}
