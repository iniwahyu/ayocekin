<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * SANDBOX
 * ONLY USE TESTING
 */
Route::get('/sandbox/mail-register', 'SandboxController@mailRegister');
Route::get('/sandbox/mail-forgot', 'SandboxController@mailForgot');

/**
 * LANDING
 */
// Home
Route::get('/', 'Landing\HomeController@index');

// Contact
Route::get('/contact', 'Landing\ContactController@index');
Route::post('/contact/store', 'Landing\ContactController@store');

// About
Route::get('/about', 'Landing\AboutController@index');

// Auth Buyer
Route::get('/register', 'Landing\AuthController@register');
Route::post('/register-proses', 'Landing\AuthController@registerProses');
Route::get('/activation/{kode?}', 'Landing\AuthController@activation');
Route::get('/verification/{id?}', 'Landing\AuthController@verification');
Route::post('/verification-proses', 'Landing\AuthController@verificationProses');
Route::get('/verification-regenerate/{usersId?}', 'Landing\AuthController@verificationRegenerate');
Route::get('/thanks', 'Landing\AuthController@thanks');
Route::get('/forgot', 'Landing\AuthController@forgot');
Route::post('/forgot-proses', 'Landing\AuthController@forgotProses');
Route::get('/recoverypass/{code?}', 'Landing\AuthController@recoveryPass');
Route::put('/recoverypass-proses/{code?}', 'Landing\AuthController@recoveryPassProses');
Route::get('/login', 'Landing\AuthController@login');
Route::post('/login-proses', 'Landing\AuthController@loginProses');
Route::get('/logout', 'Landing\AuthController@logout');

/**
 * AUTH Admin
 */
Route::get('/bunker/login', 'AuthController@loginBunker');
Route::post('/bunker/login-proses', 'AuthController@loginBunkerProses');

Route::middleware(['buyer'])->group(function () {

    // Setting
    // Profile
    Route::get('/setting/profile', 'Landing\Setting\ProfileController@index');
    Route::put('/setting/profile/update/{profileId?}', 'Landing\Setting\ProfileController@update');
    Route::put('/setting/profile/update-password/{profileId?}', 'Landing\Setting\ProfileController@updatePassword');

    // History
    Route::get('/setting/history/get-data', 'Landing\Setting\HistoryController@getData');
    Route::get('/setting/history', 'Landing\Setting\HistoryController@index');
    Route::get('/setting/history/detail/{codeInvoice?}', 'Landing\Setting\HistoryController@detail');

    // Product
    Route::get('/product/{slug?}', 'Landing\ProductController@index');

    // Payment
    Route::get('/payment/get-list/{type?}', 'Landing\PaymentController@getPaymentList');
    Route::post('/payment/order', 'Landing\PaymentController@order');
    Route::get('/payment/checkout', 'Landing\PaymentController@checkout');
    Route::post('/payment/paying', 'Landing\PaymentController@paying');
});

Route::middleware(['super'])->group(function () {
    // get data
    Route::get('/master/role', 'MasterController@role');
    Route::get('/superadmin/user/get-data', 'Superadmin\UserController@getData');
    Route::get('/superadmin/userrole/get-data', 'Superadmin\UserRoleController@getData');
    Route::get('/superadmin/game/get-data', 'Superadmin\GameMasterController@getData');
    Route::get('/superadmin/banner/get-data', 'Superadmin\BannerController@getData');

    // Dashboard
    Route::get('/superadmin/dashboard/count-topup', 'Superadmin\DashboardController@countTopup');

    // Pengecualian
    Route::get('/superadmin/game_produk/create/{id}', 'Superadmin\GameProdukController@create'); 

    // resource
    Route::resource('/superadmin/order', 'Superadmin\OrderTopupController');
    Route::resource('/superadmin/dashboard', 'Superadmin\DashboardController');
    Route::resource('/superadmin/profile', 'Superadmin\ProfileController');
    Route::resource('/superadmin/user', 'Superadmin\UserController');
    Route::resource('/superadmin/userrole', 'Superadmin\UserRoleController');
    Route::resource('/superadmin/game', 'Superadmin\GameMasterController');
    Route::resource('/superadmin/game_produk', 'Superadmin\GameProdukController');
    Route::resource('/superadmin/payment_qrcode', 'Superadmin\PaymentQrcodeController');
    Route::resource('/superadmin/bankManual', 'Superadmin\BankManualController');
    Route::resource('/superadmin/banner', 'Superadmin\BannerController');
});