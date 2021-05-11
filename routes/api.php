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
Route::post('packages', 'ApiController@showBalancePackage');
Route::post('balance_order', 'ApiController@charge_balance');
//Bill Order
Route::post('bill_order', 'ApiController@charge_bill');
//Vendor
Route::post('vendor_request','ApiController@vendor_request');
//Products
Route::post('product_request','ApiController@add_product');
Route::post('my_products','ApiController@my_products');
Route::post('all_products','ApiController@all_products');
Route::post('delete_product','ApiController@delete_product');
Route::post('product_sections','ApiController@product_sections');


Route::get('/welcome','ApiController@show_welcome');
Route::get('/newsticker','ApiController@show_newsticker');
Route::get('/slider','ApiController@show_slider');
Route::get('/socail_media','ApiController@show_socialmedia');

Route::get('/payment','PaymentController@paymentProcess');

Route::post('/verify', 'VerifyController@VerifyEmail');
