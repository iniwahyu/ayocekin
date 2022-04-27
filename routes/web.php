<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

// User
Route::get('/superadmin/user/get-data', 'Superadmin\UserController@getData');
Route::resource('/superadmin/user', 'Superadmin\UserController');

// User Role