<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('presensi', function () {
    return view('presensi');
});
Route::get('kas', function () {
    return view('kas');
});
Route::get('laporan', function () {
    return view('laporan');
});
Route::get('in', function () {
    return view('in');
});

Route::get('/beranda', [BerandaController::class, 'index']);