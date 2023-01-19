<?php

use Illuminate\Support\Facades\Route;

// Controller 
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

    // auth
    Route::get('login',     [AuthController::class, 'index'])->name('auth.index');
    Route::post('login',    [AuthController::class, 'login'])->name('auth.login');
    Route::get('daftar',    [AuthController::class, 'create'])->name('auth.daftar');
    Route::post('daftar',   [AuthController::class, 'store'])->name('auth.store');
    Route::post('logout',   [AuthController::class, 'logout'])->name('auth.logout');


Route::group(['middleware' => ['admin:admin']], function(){
    //Data Admin
    Route::get('admin',                     [MenuAdminController::class, 'admin'])->name('admin');
    Route::post('admin',                    [MenuAdminController::class,'createAdmin'])->name('admin.createAdmin');
    Route::post('admin/update/{id}',        [MenuAdminController::class,'updateAdmin'])->name('admin.updateAdmin');

    //data absen 
    Route::get('absensiManual', [DataAbsenController::class, 'index'])->name('absensiManual');
    Route::get('alpaIzin',      [DataAbsenController::class, 'izin'])->name('alpaIzin');

    //data rekap
    Route::get('dataAbsensi',   [DataAbsenController::class, 'dataabsensi'])->name('dataAbsensi');
    Route::get('dataAlpaIzin',  [DataAbsenController::class, 'dataalpaizin'])->name('dataAlpaIzin');
    Route::get('datatelat',     [DataAbsenController::class, 'datatelat'])->name('datatelat');
});


//Route Profil
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profil',               [MenuPegawaiController::class, 'index'])->name('profil.index');
    Route::get('/profil/create',        [MenuPegawaiController::class, 'create'])->name('profil.create');
    Route::post('/profil/PUpdate/{id}', [MenuPegawaiController::class, 'PUpdate'])->name('PUpdate');
    Route::post('crop',                 [MenuPegawaiController::class, 'crop'])->name('crop');
    Route::post('change-password',      [MenuPegawaiController::class, 'changePassword'])->name('ChangePw');
});

    //Route MenuPegawai
    Route::get('presensi',       [MenuPegawaiController::class, 'presensi'])->name('pegawai.presensi');

    Route::get('/task',          [MenuPegawaiController::class, 'task'])->name('pegawai.task');
    Route::get('/task/create',   [MenuPegawaiController::class, 'taskCreate'])->name('pegawai.taskCreate');

    //Presensi
    Route::post('presensi',             PresensiController::class)->name('presensi.store');
