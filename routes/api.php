<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::post('storebill','BillOrderController@store');
// Route::post('vendorRequest','ApiController@vendorRequest');



//Auth Routes 
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
// Route::post('logout', 'Auth\LoginController@logout');

//Balance Order
Route::post('storebalance','BalanceOrderController@store');


Route::get('/welcome','WelcomeController@showapi');
Route::get('/newsticker','NewstickerController@showapi');
Route::get('/slider','SliderController@showapi');
Route::get('/socail_media','SocailmediaController@showapi');

Route::get('/payment','PaymentController@paymentProcess');


