<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

// Welcome Page
Route::get('/welcome_page', 'WelcomeController@index');
Route::get('/welcome_page/create', 'WelcomeController@create');
Route::post('/welcome_page/store', 'WelcomeController@store');
Route::delete('/welcome_page/delete/{id}', 'WelcomeController@destroy');
Route::get('/welcome_page/edit/{id}', 'WelcomeController@edit');
Route::post('/welcome_page/update/{id}', 'WelcomeController@update');

//Slider
Route::get('/slider', 'SliderController@index');
Route::get('/slider/create', 'SliderController@create');
Route::post('/slider/store', 'SliderController@store');
Route::delete('/slider/delete/{id}', 'SliderController@destroy');

// Animated Bar
Route::get('/animated_bar', 'NewstickerController@index');
Route::get('/animated_bar/create', 'NewstickerController@create');
Route::post('/animated_bar/store', 'NewstickerController@store');
Route::delete('/animated_bar/delete/{id}', 'NewstickerController@destroy');
Route::get('/animated_bar/edit/{id}', 'NewstickerController@edit');
Route::post('/animated_bar/update/{id}', 'NewstickerController@update');

//Socail Media Links
Route::get('/socail_media','SocailmediaController@index');
Route::post('/socail_media/update','SocailmediaController@update');

