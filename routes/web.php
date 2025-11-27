<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JadwalController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Show login page
Route::get('/in', function () {
    return view('in');
})->name('login');

// Process login
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Search Routes
Route::get('/items-kas', [SearchController::class, 'cariNamaKas'])->name('kas.index');
Route::get('/items-presensi', [SearchController::class, 'cariNamaPresensi'])->name('presensi.index');
Route::get('/items-laporan', [SearchController::class, 'cariNamaLaporan'])->name('laporan.index');



/*
|--------------------------------------------------------------------------
| Protected Routes (Require Login)
|--------------------------------------------------------------------------
*/
Route::middleware('siswaAuth')->group(function () {
    Route::get('/presensi', [AbsensiController::class, 'index'])->name('presensi');
    Route::get('/kas', [KasController::class, 'show_kas'])->name('kas');
    Route::get('/laporan', [KasController::class, 'show_laporan'])->name('laporan');
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');


    // Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
