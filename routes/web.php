<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * LANDING
 */
// Auth
Route::get('/register', 'Landing\HomeController@register');
Route::post('/register-proses', 'Landing\HomeController@registerProses');
Route::get('/login', 'Landing\HomeController@login');
Route::post('/login-proses', 'Landing\HomeController@loginProses');
Route::get('/logout', 'Landing\HomeController@logout');

// Home
Route::get('/', 'Landing\HomeController@index');

// Setting
Route::get('/setting/profile', 'Landing\Setting\ProfileController@index');

// Product
Route::get('/product/{slug?}', 'Landing\ProductController@index');

// Payment
Route::get('/payment/get-list/{type?}', 'Landing\PaymentController@getPaymentList');
Route::post('/payment/order', 'Landing\PaymentController@order');
Route::get('/payment/checkout', 'Landing\PaymentController@checkout');
Route::post('/payment/paying', 'Landing\PaymentController@paying');

// History
Route::get('/history', 'Landing\HistoryController@index');

/**
 * AUTH
 */
Route::get('/bunker/login', 'AuthController@loginBunker');
Route::post('/bunker/login-proses', 'AuthController@loginBunkerProses');

/**
 * GLOBAL
 */
// Master
Route::get('/master/role', 'MasterController@role');

/**
 * 
 */
// Dashboard
Route::resource('/superadmin/dashboard', 'Superadmin\DashboardController');

// Profie
Route::resource('/superadmin/profile', 'Superadmin\ProfileController');

// User
Route::get('/superadmin/user/get-data', 'Superadmin\UserController@getData');
Route::resource('/superadmin/user', 'Superadmin\UserController');

// User Role
Route::get('/superadmin/userrole/get-data', 'Superadmin\UserRoleController@getData');
Route::resource('/superadmin/userrole', 'Superadmin\UserRoleController');

// Game
Route::get('/superadmin/game/get-data', 'Superadmin\GameMasterController@getData');
Route::resource('/superadmin/game', 'Superadmin\GameMasterController');


Route::resource('/superadmin/game_produk', 'Superadmin\GameProdukController');
Route::resource('/superadmin/pembayaran', 'Superadmin\BankManualController');