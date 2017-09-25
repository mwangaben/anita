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


    public function challenge()
    {
    	  return $this->belongsToMany(Challenge::class);
    }
}
