<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TransaksiController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Barang
    Volt::route('barang', 'pages.barang.list')
        ->name('barang.index');
    Volt::route('barang/tambah', 'pages.barang.add')
        ->name('barang.create');
    // Route::resource('barang', BarangController::class);

    // User
    Volt::route('pengguna', 'pages.user.list')
        ->name('user.index');
    Volt::route('pengguna/tambah', 'pages.user.add')
        ->name('user.create');
    Route::get('pengguna/{id}', [UserController::class, 'show'])->name('user.show');
    // Route::resource('user', UserController::class);
    Route::resource('transaksi', TransaksiController::class);
});
