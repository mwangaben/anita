<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;

class ChallengeProductController extends Controller
{
    public function store(Request $request, Challenge $challenge)
    {	
      $challenge = Challenge::find($request->challenge);
  
   	  $challenge->products()->toggle($request->product);
    }
}
