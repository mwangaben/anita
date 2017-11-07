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
    return view('layouts.master');
});

//Messages form contact us page
Route::resource('messages', 'ContactUsesController');

Route::get('auth', function () {
    return view('auth.register');
});

Route::resource('mocks', 'MocksController');

Route::resource('about', 'AboutController');

Route::resource('events', 'EventsController');

Route::resource('products', 'ProductsController');

Route::resource('challenges', 'ChallengesController');

Route::resource('challengesproducts', 'ChallengeProductController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
