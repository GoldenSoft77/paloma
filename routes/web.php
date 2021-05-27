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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');

Auth::routes(['verify' => true]);
Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'HomeController@index')->name('home');
});

//Admin Routes




Route::namespace("Admin")->prefix('admin')->group(function(){
    Route::get('/', 'HomeController@index')->name('admin.home');
  // Welcome Page
  Route::get('/welcome_page', 'WelcomeController@index');
  Route::get('/welcome_page/create', 'WelcomeController@create');
  Route::post('/welcome_page/store', 'WelcomeController@store');
  Route::delete('/welcome_page/delete/{id}', 'WelcomeController@destroy');
  Route::get('/welcome_page/edit/{id}', 'WelcomeController@edit');
  Route::post('/welcome_page/update/{id}', 'WelcomeController@update');
//Balance Packages 
Route::get('/balancepackages', 'BalancePackageController@index');
Route::get('/balancepackages/add', 'BalancePackageController@create');
Route::get('/balancepackages/edit/{id}', 'BalancePackageController@edit');

Route::post('/balancepackages/store', 'BalancePackageController@store');
Route::post('/balancepackages/update/{id}', 'BalancePackageController@update');
Route::delete('/balancepackages/delete/{id}', 'BalancePackageController@destroy');

//Balance Orders 
Route::get('/balanceorders', 'BalanceOrderController@finish_orders');
Route::get('/mtn_balanceorders', 'BalanceOrderController@pending_mtn');
Route::get('/syriatel_balanceorders', 'BalanceOrderController@pending_syriatel');
Route::get('/balanceorders/charge/{id}', 'BalanceOrderController@charge_balance');
//Bill Orders 
Route::get('/billorders', 'BillOrderController@finish_orders');
Route::get('/pending_electricity', 'BillOrderController@pending_electricity');
Route::get('/pending_water', 'BillOrderController@pending_water');
Route::get('/pending_phone', 'BillOrderController@pending_phone');
Route::get('/billorders/approve/{id}', 'BillOrderController@approve_bill');


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

//Vendors
Route::get('/pending_vendors','VendorController@pending');
Route::get('/vendors','VendorController@index');
Route::get('/vendors/approve/{id}', 'VendorController@approve_vendor');

//Products
Route::get('/products','ProductController@index');
Route::get('/pending_products','ProductController@pending');
Route::get('/products/approve/{id}', 'ProductController@approve_product');
Route::delete('/products/delete/{id}', 'ProductController@approve_product_delete');
Route::get('/products/add', 'ProductController@create');
Route::post('/products/store', 'ProductController@store');

//online store
Route::get('/onlineorders','OnlineOrderController@index');
Route::get('/pending_orders','OnlineOrderController@pending');
Route::get('/onlineorders/edit/{id}', 'OnlineOrderController@edit');
Route::post('/onlineorders/add_shipping/{id}', 'OnlineOrderController@add_shipping_cost');
Route::get('/onlineorders/change/{id}', 'OnlineOrderController@change');
Route::post('/onlineorders/change_status/{id}', 'OnlineOrderController@change_status');

//Product Sections
Route::get('/productsections', 'ProductSectionController@index');
Route::get('/productsections/add', 'ProductSectionController@create');
Route::get('/productsections/edit/{id}', 'ProductSectionController@edit');

Route::post('/productsections/store', 'ProductSectionController@store');
Route::post('/productsections/update/{id}', 'ProductSectionController@update');
Route::delete('/productsections/delete/{id}', 'ProductSectionController@destroy');


    Route::namespace('Auth')->group(function(){
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('admin.logout');
  
    });
   });

Route::get('stripe', 'StripePaymentController@stripe');
Route::post('charge', 'BalanceOrderController@charge');
Route::get('/', function () {
  return redirect('/admin/login');
});
