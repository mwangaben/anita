<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('layouts.master');
});

//Messages form contact us page
Route::resource('messages', 'ContactUsesController');


// Route for about page
Route::resource('about', 'AboutController');

Route::resource('events', 'EventsController');














