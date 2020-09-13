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
    Route::get('/index','DashboardController@index')->name('index');
});

Route::prefix('4dm1n')->namespace('Admins')->group(function () {
    Route::get('/login','AuthController@login_form')->name('admin.login.form');
    Route::post('/login','AuthController@login')->name('admin.login');
    
    Route::middleware('auth:admin')->group(function(){
        Route::get('/index','DashboardController@index')->name('admin.index');

        Route::prefix('lokasi-magang')->group(function(){
            Route::get('/','LokasiMagangController@index')->name('lokasi-magang.index');
            Route::post('/','LokasiMagangController@store')->name('lokasi-magang.tambah');
            Route::post('/edit','LokasiMagangController@edit')->name('lokasi-magang.edit');
            Route::post('/delete','LokasiMagangController@delete')->name('lokasi-magang.delete');
            
        });
    });
});
