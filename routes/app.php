<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/filter', [PublicController::class, 'filter'])->name('filter');
Route::get('/kategori/{id}', [PublicController::class, 'category'])->name('category');
Route::get('/detail/{id}', [PublicController::class, 'detail'])->name('detail');

Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [AuthenticatedController::class, 'cart'])->name('cart');
    Route::get('/profil', [AuthenticatedController::class, 'profile'])->name('profile');
    Route::get('/transaksi', [AuthenticatedController::class, 'transactionList'])->name('user.transactions');
    Route::get('/transaksi/{id}', [AuthenticatedController::class, 'transactionDetail'])->name('user.transaction.detail');
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});
