<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'pages.home')->name('home');
Volt::route('/filter', 'pages.filter')->name('filter');
Volt::route('/detail/{id}', 'pages.detail')->name('detail');

Route::middleware('auth')->group(function () {
    Volt::route('/keranjang', 'pages.cart')->name('cart');
    Route::get('/profil', [AuthenticatedController::class, 'profile'])->name('profile');
    Volt::route('/transaksi', 'pages.transactions')->name('user.transactions');
    Volt::route('/transaksi/{id}', 'pages.transaction')->name('user.transaction.show');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Volt::route('/konfirmasi', 'pages.confirmation')->name('confirmation');
});
