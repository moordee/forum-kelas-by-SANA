<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\AbsensiController;
use App\Models\Absensi;

Route::get('/presensi', function () {
    if (!session('siswa_logged_in')) {
        return redirect()->route('login');
    }
    return app(AbsensiController::class)->index();
});

Route::get('kas', function () {
    if (!session('siswa_logged_in')) {
        return redirect()->route('login');
    }
    return app(KasController::class)->show_kas();
});

Route::get('laporan', function () {
    if (!session('siswa_logged_in')) {
        return redirect()->route('login');
    }
    return app(KasController::class)->show_laporan();
});

// Show login page
Route::get('/in', function () {
    return view('in');
})->name('login');

// Process login
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.process');

// Dashboard
Route::get('/beranda', function () {
    // protect the page
    if (!session('siswa_logged_in')) {
        return redirect()->route('login');
    }

    return app(BerandaController::class)->index();
})->name('beranda');

Route::get('absensi', function () {
    if (!session('siswa_logged_in')) {
        return redirect()->route('login');
    }
    return app(AbsensiController::class)->index();
});

// Logout
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
