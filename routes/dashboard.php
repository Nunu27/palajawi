<?php

use App\Http\Controllers\Dashboard\BarangController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\TransaksiController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Barang
    Volt::route('barang', 'pages.barang.list')->name('barang.index');
    Volt::route('barang/tambah', 'pages.barang.add')->name('barang.create');
    Volt::route('barang/{id}', 'pages.barang.view')->name('barang.show');
    Volt::route('barang/{id}/edit', 'pages.barang.edit')->name('barang.edit');

    // Route::resource('barang', BarangController::class);

    // Kategori
    Volt::route('kategori', 'pages.kategori.list')
        ->name('kategori.index');

    // User
    Volt::route('pengguna', 'pages.user.list')
        ->name('user.index');
    Volt::route('pengguna/tambah', 'pages.user.add')
        ->name('user.create');
    Route::get('pengguna/{id}', [UserController::class, 'show'])->name('user.show');
    // Route::resource('user', UserController::class);
    Route::resource('transaksi', TransaksiController::class);
});
