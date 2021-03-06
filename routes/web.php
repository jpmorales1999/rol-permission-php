<?php

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

Auth::routes(["register" => false]);

Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/rols', 'RolController');
    Route::resource('/permissions', 'PermissionController');
    Route::resource('/users', 'UserController');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
