<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User
Route::get('/', fn () => view('home'))->name('home');
Route::get('/filter', fn () => view('filter'))->name('filter');
Route::get('/kategori/:id', fn () => view('category'))->name('category');
Route::get('/detail/:id', fn () => view('detail'))->name('detail');
Route::get('/cart', fn () => view('cart'))->name('cart');
Route::get('/profil', fn () => view('profile'))->name('profile');
Route::get('/transaksi', fn () => view('transaction-list'))->name('transaction');
Route::get('/transaksi/:id', fn () => view('transaction'))->name('transaction-detail');

// Admin
Route::get('/dashboard', fn () => view('dashboard.dashboard'))->name('dashboard');

Route::get('/dashboard/barang', fn () => view('dashboard.barang.list'))->name('dashboard-barang');
Route::get('/dashboard/barang/tambah', fn () => view('dashboard.barang.add'))->name('dashboard-barang-tambah');
Route::get('/dashboard/barang/edit', fn () => view('dashboard.barang.edit'))->name('dashboard-barang-edit');
Route::get('/dashboard/barang/:id', fn () => view('dashboard.barang.detail'))->name('dashboard-barang-detail');

Route::get('/dashboard/transaksi', fn () => view('dashboard.transaksi.list'))->name('dashboard-transaksi');
Route::get('/dashboard/transaksi/:id', fn () => view('dashboard.transaksi.detail'))->name('dashboard-transaksi-detail');

Route::get('/dashboard/user', fn () => view('dashboard.user.list'))->name('dashboard-user');
Route::get('/dashboard/user/:id', fn () => view('dashboard.user.detail'))->name('dashboard-user-detail');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
