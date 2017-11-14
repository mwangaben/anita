<?php

namespace App\Http\Controllers;

use App\HomeSection;
use Illuminate\Http\Request;

class HomeSectionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (request()->expectsJson()) {
        //     return HomeSection::all();
        // }

        return HomeSection::all();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function show(HomeSection $homeSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeSection $homeSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeSection  $homesection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSection $homesection)
    {

        $this->authorize('update', $homesection);

        $filterData = $request->validate([
            'introlead'  => 'required|max:100',
            'introhead'  => 'required|max:100',
            'infoButton' => 'required|max:25',
        ]);

        $data = [
            'introlead'  => $filterData['introlead'],
            'introhead'  => $filterData['introhead'],
            'infoButton' => $filterData['infoButton'],
            'user_id'    => auth()->user()->id,

        ];
        $homesection->update($data);
        if (request()->wantsJson()) {
            return response(['okay'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeSection  $homeSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeSection $homeSection)
    {
        //
    }
}
