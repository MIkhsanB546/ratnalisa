<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\KategoriLayananController;
use App\Http\Controllers\LayananController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('admin.login');
    
    Route::resource('pasien', PasienController::class);
    Route::resource('kategori-layanan', KategoriLayananController::class);
    Route::resource('layanan', LayananController::class);
});
