<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
Route::group(array('prefix' => 'admin', 'before' => ''), function() {
// main page for the admin section (app/views/admin/dashboard.blade.php)
    Route::resource('pegawai', 'PegawaiController');
    Route::resource('statuspegawai', 'StatusPegawaiController');
    Route::resource('golongan', 'GolonganController');
    Route::resource('eselon', 'EselonController');
    Route::resource('satuankerja', 'SatuanKerjaController');
    Route::resource('unitkerja', 'UnitKerjaController');
    Route::resource('ppk', 'PpkController');
    Route::resource('pelatihan', 'PelatihanController');
    Route::resource('jabatan', 'JabatanController');
    Route::resource('statusjabatan', 'StatusJabatanController');
    Route::resource('penghargaan', 'PenghargaanController');
    Route::resource('hukuman', 'HukumanController');
    Route::resource('lokasipelatihan', 'LokasiPelatihanController');
    Route::resource('lokasikerja', 'LokasiKerjaController');
    Route::get('pegawai/edit/{id}/keluarga','KeluargaController@index');
    Route::resource('keluarga','KeluargaController');
    Route::get('/dropdownunitkerja', 'UnitKerjaController@getUnitKerja');
    Route::get('/dropdownsatuankerja', 'SatuanKerjaController@getSatuanKerja');
    Route::get('/dropdowneselon', 'EselonController@getEselon');
});


Route::get('/', function() {
    return View::make('index'); // will return app/views/index.php
});


// =============================================
// CATCH ALL ROUTE =============================
// =============================================
//This will redirect all missing routes to AngularJS Framework .
App::missing(function($exception) {
    return View::make('index');
});

