<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
Route::get('/', 'Landing\HomeController@index');

/**
 * LANDING
 */
// Auth Buyer
Route::get('/register', 'Landing\HomeController@register');
Route::post('/register-proses', 'Landing\HomeController@registerProses');
Route::get('/login', 'Landing\HomeController@login');
Route::post('/login-proses', 'Landing\HomeController@loginProses');
Route::get('/logout', 'Landing\HomeController@logout');

/**
 * AUTH Admin
 */
Route::get('/bunker/login', 'AuthController@loginBunker');
Route::post('/bunker/login-proses', 'AuthController@loginBunkerProses');

Route::middleware(['buyer'])->group(function () {

    // Setting
    // Profile
    Route::get('/setting/profile', 'Landing\Setting\ProfileController@index');

    // History
    Route::get('/setting/history/get-data', 'Landing\Setting\HistoryController@getData');
    Route::get('/setting/history', 'Landing\Setting\HistoryController@index');


    // Product
    Route::get('/product/{slug?}', 'Landing\ProductController@index');

    // Payment
    Route::get('/payment/get-list/{type?}', 'Landing\PaymentController@getPaymentList');
    Route::post('/payment/order', 'Landing\PaymentController@order');
    Route::get('/payment/checkout', 'Landing\PaymentController@checkout');
    Route::post('/payment/paying', 'Landing\PaymentController@paying');
});

Route::middleware(['admin'])->group(function () {
    // get data
    Route::get('/master/role', 'MasterController@role');
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