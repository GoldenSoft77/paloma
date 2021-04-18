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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Balance Packages Orders
Route::get('/balancepackages', 'BalancePackageController@index');
Route::get('/balancepackages/add', 'BalancePackageController@create');
Route::get('/balancepackages/edit/{id}', 'BalancePackageController@edit');

Route::post('/balancepackages/store', 'BalancePackageController@store');
Route::post('/balancepackages/update/{id}', 'BalancePackageController@update');
Route::delete('/balancepackages/delete/{id}', 'BalancePackageController@destroy');
