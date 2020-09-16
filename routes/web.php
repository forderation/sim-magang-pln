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

// Route peserta magang
Route::namespace('Frontends')->group(function () {
    Route::get('/login', 'AuthController@login_form')->name('login.form');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/register', 'AuthController@register_form')->name('register.form');
    Route::post('/register', 'AuthController@register')->name('register');
    Route::middleware('auth')->group(function () {

        Route::get('/', 'DashboardController@index')->name('index');
        Route::get('/profil', 'DashboardController@profil_form')->name('profil');
        Route::get('/sertifikat', 'DashboardController@sertifikat')->name('front.sertifikat');
        Route::get('/pelaksanaan', 'DashboardController@pelaksanaan')->name('front.pelaksanaan');
        Route::post('/profil', 'DashboardController@update_profil')->name('profil.update');
        Route::post('/update-password', 'DashboardController@update_password')->name('password.update');
        Route::get('/home', 'DashboardController@home')->name('home.index');
        Route::get('/proposal/{id_magang}', 'DashboardController@getFileProposal')->name('home.file.proposal');
        Route::get('/sp/{id_magang}', 'DashboardController@getFileSP')->name('home.file.sp');

        Route::prefix('pengajuan-magang')->group(function () {
            Route::get('/index', 'PengajuanMagangController@index')->name('pengajuan-magang.index');
            Route::get('/daftar/{id}', 'PengajuanMagangController@daftar')->name('pengajuan-magang.daftar');
            Route::post('/submit', 'PengajuanMagangController@submit')->name('pengajuan-magang.submit');
        });
    });
});


// Route admin
Route::namespace('Admins')->group(function () {
    Route::get('/file-sertifikat/{id}', 'SertifikatController@getFileSertifikat')->name('sertifikat-magang.file');
    Route::get('/file-pelaksanaan/{id}', 'PelaksanaanMagangController@getFilePelaksanaan')->name('pelaksanaan-magang.file');

    Route::prefix('4dm1n')->group(function () {
        Route::get('/login', 'AuthController@login_form')->name('admin.login.form');
        Route::post('/login', 'AuthController@login')->name('admin.login');
        Route::get('/logout', 'AuthController@logout')->name('admin.logout');
        Route::middleware('auth:admin')->group(function () {
            Route::get('/index', 'DashboardController@index')->name('admin.index');

            Route::get('/{id}/setuju', 'DashboardController@setujui_proposal')->name('admin.setuju-magang');
            Route::get('/{id}/tolak', 'DashboardController@tolak_proposal')->name('admin.tolak-magang');

            Route::prefix('lokasi-magang')->group(function () {
                Route::get('/', 'LokasiMagangController@index')->name('lokasi-magang.index');
                Route::post('/', 'LokasiMagangController@store')->name('lokasi-magang.tambah');
                Route::post('/edit', 'LokasiMagangController@edit')->name('lokasi-magang.edit');
                Route::post('/delete', 'LokasiMagangController@delete')->name('lokasi-magang.delete');
            });

            Route::prefix('peserta-magang')->group(function () {
                Route::get('/', 'PesertaMagangController@index')->name('peserta-magang.index');
            });

            Route::prefix('daftar-akun')->group(function () {
                Route::get('/', 'LokasiMagangController@index')->name('daftar-akun.index');
            });

            Route::prefix('pelaksanaan-magang')->group(function () {
                Route::get('/', 'PelaksanaanMagangController@index')->name('pelaksanaan-magang.index');
                Route::post('/submit', 'PelaksanaanMagangController@submit')->name('pelaksanaan-magang.submit');
                Route::post('/update', 'PelaksanaanMagangController@update')->name('status-magang.update');
            });

            Route::prefix('sertifikat-magang')->group(function () {
                Route::get('/', 'SertifikatController@index')->name('sertifikat-magang.index');
                Route::post('/submit', 'SertifikatController@submit')->name('sertifikat-magang.submit');
                Route::post('/update', 'SertifikatController@update')->name('sertifikat-magang.update');
            });
        });
    });
});
