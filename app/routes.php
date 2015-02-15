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
    Route::get('pegawai/edit/{id}/keluarga', 'KeluargaController@index');
    Route::resource('keluarga', 'KeluargaController');
    Route::get('pegawai/edit/{id}/riwayatpangkat', 'RiwayatPangkatController@index');
    Route::resource('riwayatpangkat', 'RiwayatPangkatController');
    Route::get('pegawai/edit/{id}/riwayatjabatan', 'RiwayatJabatanController@index');
    Route::resource('riwayatjabatan', 'RiwayatJabatanController');
    Route::get('pegawai/edit/{id}/pendidikan', 'PendidikanController@index');
    Route::resource('pendidikan', 'PendidikanController');
    Route::get('pegawai/edit/{id}/pelatihanpegawai', 'PelatihanPegawaiController@index');
    Route::resource('pelatihanpegawai', 'PelatihanPegawaiController');
    Route::get('pegawai/edit/{id}/penghargaanpegawai', 'PenghargaanPegawaiController@index');
    Route::resource('penghargaanpegawai', 'PenghargaanPegawaiController');
    Route::get('pegawai/edit/{id}/seminar', 'SeminarController@index');
    Route::resource('seminar', 'SeminarController');
    Route::get('pegawai/edit/{id}/organisasi', 'OrganisasiController@index');
    Route::resource('gajipokok', 'GajiPokokController');
    Route::get('pegawai/edit/{id}/gajipokok', 'GajiPokokController@index');
    Route::resource('organisasi', 'OrganisasiController');
    Route::resource('hukumanpegawai', 'HukumanPegawaiController');
    Route::get('pegawai/edit/{id}/hukumanpegawai', 'HukumanPegawaiController@index');
    Route::resource('dp3', 'Dp3Controller');
    Route::get('pegawai/edit/{id}/dp3', 'Dp3Controller@index');
    Route::resource('users', 'UsersController');
    Route::get('/dropdownunitkerja', 'UnitKerjaController@getUnitKerja');
    Route::get('/dropdownsatuankerja', 'SatuanKerjaController@getSatuanKerja');
    Route::get('/dropdowneselon', 'EselonController@getEselon');
});


Route::get('/', function() {
    return View::make('index'); // will return app/views/index.php
});

Route::post('login/auth', 'HomeController@Login');
Route::get('login/destroy', 'HomeController@Logout');

// =============================================
// CATCH ALL ROUTE =============================
// =============================================
//This will redirect all missing routes to AngularJS Framework .
App::missing(function($exception) {
    return View::make('index');
});

