<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;

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
