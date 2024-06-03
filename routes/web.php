<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});


Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::get('/barang', [BarangController::class, 'index'])->name('barangs');
Route::post('/barang', [BarangController::class, 'store'])->name('barangs.store');
Route::post('/barang/{id}', [BarangController::class, 'delete'])->name('barangs.delete');
Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barangs.update');

Route::get('/user', [UserController::class, 'index'])->name('users');
Route::post('/users/{id}', [BarangController::class, 'delete'])->name('users.delete');

Route::get('/orders', [PembelianController::class, 'index'])->name('orders.index');
Route::post('/orders/delete/{snap_token}', [PembelianController::class, 'delete'])->name('orders.delete');
Route::get('/orders/user/{id}', [PembelianController::class, 'order_user'])->name('orders.order_user');
Route::get('/orders/detail/{snap_token}', [PembelianController::class, 'detail_web'])->name('orders.detail_web');

// Registration
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');


// API =====================

// Get Barang
// Route::get('/barangs_api', [BarangController::class, 'index_api'])->name('barangs_api');

// Get User
// Route::get('/users_api', [UserController::class, 'index_api'])->name('users');

// Auth
// Route::post('/custom-registration_api', [CustomAuthController::class, 'customRegistration_api'])->name('register.custom_api');
// Route::post('/custom-login_api', [CustomAuthController::class, 'customLogin_api'])->name('login.custom_api');

// Lihat riwayat
// Route::get('/orders_api/user/{id}', [PembelianController::class, 'order_user_api'])->name('orders.order_user_api');


require __DIR__ . '/auth.php';
