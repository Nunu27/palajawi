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
    Volt::route('kategori', 'pages.kategori.list')->name('kategori.index');
    Volt::route('kategori/tambah', 'pages.kategori.add')->name('kategori.create');
    Volt::route('kategori/{id}', 'pages.kategori.view')->name('kategori.show');
    Volt::route('kategori/{id}/edit', 'pages.kategori.edit')->name('kategori.edit');


    // User
    Volt::route('pengguna', 'pages.user.list')
        ->name('user.index');
    Volt::route('pengguna/tambah', 'pages.user.add')
        ->name('user.create');
    Route::get('pengguna/{id}', [UserController::class, 'show'])->name('user.show');
    // Route::resource('user', UserController::class);

    // Transaksi
    Volt::route('transaksi', 'pages.transaksi.list')->name('transaksi.index');
    Volt::route('transaksi/tambah', 'pages.transaksi.add')->name('transaksi.create');
    Volt::route('transaksi/{id}', 'pages.transaksi.view')->name('transaksi.show');
    // Route::resource('transaksi', TransaksiController::class);
});
