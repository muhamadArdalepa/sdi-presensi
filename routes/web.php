<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DataAbsenController;
use App\Http\Controllers\MenuPegawaiController;
use App\Http\Controllers\PresensiController;

// home
Route::get('/', function () {
    return view('index')->with([
        'title' => 'Sabang Digital Indonesia'
    ]);
})->name('menu.home')->middleware('auth');

// admin
Route::get('admin/pegawai', [MenuAdminController::class, 'pegawai'])->name('admin.pegawai')->middleware('auth');
Route::get('admin/admin', [MenuAdminController::class, 'admin'])->name('admin.admin')->middleware('auth');

// auth
Route::get('login', [AuthController::class, 'index'])->name('auth.index');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('daftar', [AuthController::class, 'create'])->name('auth.daftar');
Route::post('daftar', [AuthController::class, 'store'])->name('auth.store');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

// resource
Route::prefix('resource')->group(function () {
    Route::resource('/pegawai', PegawaiController::class)->middleware('auth');
    Route::resource('/admin', AdminController::class)->middleware('auth');
});

//data absen 
Route::get('absensiManual', [DataAbsenController::class, 'index'])->name('absensiManual');
Route::get('alpaIzin',      [DataAbsenController::class, 'izin'])->name('alpaIzin');

//data rekap
Route::get('dataAbsensi',     [DataAbsenController::class, 'dataabsensi'])->name('dataAbsensi');
Route::get('dataAlpaIzin',  [DataAbsenController::class, 'dataalpaizin'])->name('dataAlpaIzin');
Route::get('datatelat',     [DataAbsenController::class, 'datatelat'])->name('datatelat');



//Route Profil
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profil',               [MenuPegawaiController::class, 'index'])->name('profil.index');
    Route::get('/profil/create',        [MenuPegawaiController::class, 'create'])->name('profil.create');
    Route::post('/profil/PUpdate/{id}', [MenuPegawaiController::class, 'PUpdate'])->name('PUpdate');
    Route::post('crop',                 [MenuPegawaiController::class, 'crop'])->name('crop');
    Route::post('change-password',      [MenuPegawaiController::class, 'changePassword'])->name('ChangePw');
});

//Route MenuPegawai
Route::get('presensi',             [MenuPegawaiController::class, 'presensi'])->name('pegawai.presensi');
Route::get('task',                 [MenuPegawaiController::class, 'task'])->name('pegawai.task');


//Presensi
Route::post('masuk',             [PresensiController::class, 'masuk'])->name('presensi.store');
