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
    Route::post('/profil', [AuthenticatedController::class, 'profile']);
    Route::get('/profil/edit', [AuthenticatedController::class, 'profile'])->name('profile.edit');
    Route::get('/transaksi', [AuthenticatedController::class, 'transactionList'])->name('transaction');
    Route::get('/transaksi/{id}', [AuthenticatedController::class, 'transactionDetail'])->name('transaction.detail');

    Route::get('change-password', [AuthenticatedController::class, 'editPassword'])->name('password.edit');
    Route::put('password', [AuthenticatedController::class, 'updatePassword'])->name('password.update');
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
});
