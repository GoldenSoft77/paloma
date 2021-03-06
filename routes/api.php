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
Route::post('done_balance_orders', 'ApiController@done_balance_orders');
Route::post('pending_balance_orders', 'ApiController@pending_balance_orders');

//Bill Order
Route::post('bill_order', 'ApiController@charge_bill');
Route::post('pending_bill_orders', 'ApiController@pending_bill_orders');
Route::post('done_bill_orders', 'ApiController@done_bill_orders');
//Online Order
Route::post('pending_online_orders', 'ApiController@pending_online_orders');
Route::post('online_orders', 'ApiController@online_orders');
Route::post('online_new_order','ApiController@online_order_request');
Route::post('charge_online_order','ApiController@charge_online_order');
//International Order
Route::post('international_new_order','ApiController@international_order_request');
Route::post('pending_international_orders', 'ApiController@pending_international_orders');
Route::post('international_orders', 'ApiController@international_orders');
Route::post('charge_international_order','ApiController@charge_international_order');

//Vendor
Route::post('vendor_request','ApiController@vendor_request');
//Products
Route::post('product_request','ApiController@add_product');
Route::post('my_products','ApiController@my_products');
Route::post('all_products','ApiController@all_products');
Route::post('delete_product','ApiController@delete_product');
Route::post('product_sections','ApiController@product_sections');
Route::post('add_favorite_product', 'ApiController@add_favorite_product');
Route::post('remove_favorite_product', 'ApiController@remove_favorite_product');
Route::post('my_favorite', 'ApiController@my_favorite');



Route::get('/welcome','ApiController@show_welcome');
Route::get('/newsticker','ApiController@show_newsticker');
Route::get('/slider','ApiController@show_slider');
Route::get('/socail_media','ApiController@show_socialmedia');

Route::get('/payment','PaymentController@paymentProcess');

Route::post('/verify', 'VerifyController@VerifyEmail');

Route::post('/api_requests', 'ApiController@api_requests');

Route::post('/show_notification', 'ApiController@show_notification');
Route::post('/edit_notification', 'ApiController@edit_notification');



