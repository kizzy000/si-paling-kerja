<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPendaftarController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LowonganTersediaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LowonganPublicController;
use App\Http\Controllers\InformasiPublicController;
use App\Http\Controllers\UserController;

Route::get('/', [IndexController::class, 'index']);

Route::get('/lowongan', [LowonganPublicController::class, 'index'])->name('lowongan.index');
Route::get('/lowongan/{slug}', [LowonganPublicController::class, 'show'])->name('lowongan.show');

Route::get('/informasi', [InformasiPublicController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{slug}', [InformasiPublicController::class, 'show'])->name('informasi.show');

Route::get('auth/login', [AuthController::class, 'index'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('auth/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');

// Auth::routes();
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::middleware(['checkislogin'])->group(function () {

    // Shared Routes (both roles can access)
    Route::get('/dashboard/profil', [ProfilController::class, 'index'])->name('dashboard.profil.index');
    Route::get('/dashboard/profil/edit', [ProfilController::class, 'edit'])->name('dashboard.profil.edit');
    Route::put('/dashboard/profil', [ProfilController::class, 'update'])->name('dashboard.profil.update');

    // Shared Lamaran Routes (Moved here to prevent route collision between roles)
    Route::get('/dashboard/lamaran', [LamaranController::class, 'index'])->name('dashboard.lamaran.index');
    Route::get('/dashboard/lamaran/{id}/edit', [LamaranController::class, 'edit'])->name('dashboard.lamaran.edit');
    //perusahaan edit status
    Route::get('/dashboard/lamaran/{id}/edit-status', [LamaranController::class, 'editPerusahaan'])->name('dashboard.lamaran.edit-status');
    //update status pelamaran oleh perusahaan
    Route::put('/dashboard/lamaran/{id}/update-status', [LamaranController::class, 'updateStatuslamaran'])->name('dashboard.lamaran.update-status');
    Route::put('/dashboard/lamaran/{id}', [LamaranController::class, 'update'])->name('dashboard.lamaran.update');
    Route::delete('/dashboard/lamaran/{id}', [LamaranController::class, 'destroy'])->name('dashboard.lamaran.destroy');

    // Shared Data Pendaftar Routes (Accessible by Admin and Perusahaan)
    Route::get('/dashboard/pendaftar', [DataPendaftarController::class, 'index'])->name('dashboard.pendaftar.index');
    Route::get('/dashboard/pendaftar/{lowongan:slug}', [DataPendaftarController::class, 'pendaftar'])->name('dashboard.pendaftar.pendaftar');

    // Shared Lowongan Routes (Accessible by Admin and Perusahaan)
    Route::get('/dashboard/lowongan', [LowonganController::class, 'index'])->name('dashboard.lowongan.index');
    Route::get('/dashboard/lowongan/create', [LowonganController::class, 'create'])->name('dashboard.lowongan.create');
    Route::post('/dashboard/lowongan', [LowonganController::class, 'store'])->name('dashboard.lowongan.store');
    Route::get('/dashboard/lowongan/{lowongan:slug}', [LowonganController::class, 'show'])->name('dashboard.lowongan.show');
    Route::get('/dashboard/lowongan/{lowongan:slug}/edit', [LowonganController::class, 'edit'])->name('dashboard.lowongan.edit');
    Route::put('/dashboard/lowongan/{id}', [LowonganController::class, 'update'])->name('dashboard.lowongan.update');
    Route::delete('/dashboard/lowongan/{id}', [LowonganController::class, 'destroy'])->name('dashboard.lowongan.destroy');

    // Admin Routes
    Route::middleware(['checkrole:admin'])->group(function () {
        // Informasi Management
        Route::get('/dashboard/informasi', [InformasiController::class, 'index'])->name('dashboard.informasi.index');
        Route::get('/dashboard/informasi/create', [InformasiController::class, 'create'])->name('dashboard.informasi.create');
        Route::post('/dashboard/informasi', [InformasiController::class, 'store'])->name('dashboard.informasi.store');
        Route::get('/dashboard/informasi/{informasi:slug}', [InformasiController::class, 'show'])->name('dashboard.informasi.show');
        Route::get('/dashboard/informasi/{informasi:slug}/edit', [InformasiController::class, 'edit'])->name('dashboard.informasi.edit');
        Route::put('/dashboard/informasi/{id}', [InformasiController::class, 'update'])->name('dashboard.informasi.update');
        Route::delete('/dashboard/informasi/{id}', [InformasiController::class, 'destroy'])->name('dashboard.informasi.destroy');

        // User Management
        Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
        Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('dashboard.users.create');
        Route::post('/dashboard/users', [UserController::class, 'store'])->name('dashboard.users.store');
        Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
        Route::put('/dashboard/users/{id}', [UserController::class, 'update'])->name('dashboard.users.update');
        Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');

    });

    // Pendaftar Routes
    Route::middleware(['checkrole:pendaftar'])->group(function () {
        // Lowongan Tersedia (Available Jobs)
        Route::get('/dashboard/lowongan-tersedia', [LowonganTersediaController::class, 'index'])->name('dashboard.lowongan-tersedia.index');
        Route::get('/dashboard/lowongan-tersedia/{lowongan:slug}/daftar', [LowonganTersediaController::class, 'daftar'])->name('dashboard.lowongan-tersedia.daftar');
        Route::post('/dashboard/lowongan-tersedia/{id}/daftar', [LowonganTersediaController::class, 'store'])->name('dashboard.lowongan-tersedia.store');
    });
});
