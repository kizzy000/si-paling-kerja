<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DashboardController;

Route::get('/', [IndexController::class, 'index']);

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
