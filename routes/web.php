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

Route::namespace('Frontends')->group(function () {
    
    Route::get('/login','AuthController@login_form')->name('login.form');
    Route::post('/login','AuthController@login')->name('login');
    Route::get('/register','AuthController@register_form')->name('register.form');
    Route::post('/register','AuthController@register')->name('register');

});
