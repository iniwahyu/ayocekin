<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

// User
Route::get('/superadmin/user/get-data', 'Superadmin\UserController@getData');
Route::resource('/superadmin/user', 'Superadmin\UserController');

// User Role
Route::get('/superadmin/userrole/get-data', 'Superadmin\UserRoleController@getData');
Route::resource('/superadmin/userrole', 'Superadmin\UserRoleController');