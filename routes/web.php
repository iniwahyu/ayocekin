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

// custom
Route::get('/master/role', 'MasterController@role');


Route::middleware(['admin'])->group(function () {
    // get data
    Route::get('/superadmin/user/get-data', 'Superadmin\UserController@getData');
    Route::get('/superadmin/userrole/get-data', 'Superadmin\UserRoleController@getData');
    Route::get('/superadmin/game/get-data', 'Superadmin\GameMasterController@getData');

    // resource
    Route::resource('/superadmin/order', 'Superadmin\OrderTopupController');
    Route::resource('/superadmin/dashboard', 'Superadmin\DashboardController');
    Route::resource('/superadmin/profile', 'Superadmin\ProfileController');
    Route::resource('/superadmin/user', 'Superadmin\UserController');
    Route::resource('/superadmin/userrole', 'Superadmin\UserRoleController');
    Route::resource('/superadmin/game', 'Superadmin\GameMasterController');
    Route::resource('/superadmin/game_produk', 'Superadmin\GameProdukController');
    Route::resource('/superadmin/pembayaran', 'Superadmin\BankManualController');
});