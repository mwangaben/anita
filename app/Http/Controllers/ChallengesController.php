<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Challenge $challenge)
    {
        $this->authorize('update', $challenge);

        $validatedData = $request->validate([
            'name'        => 'required',
            'description' => 'required',
            'image_url'   => 'required',
        ]);


        auth()->user()->createChallenge($validatedData);
        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        $this->authorize('update', $challenge);

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_url' => 'required',
        ]);

        auth()->user()->updateChallenge($validatedData);

        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        $this->authorize('update', $challenge);
        
    }
}
