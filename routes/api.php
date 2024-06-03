<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\handleController;
use App\Http\Controllers\handleNotification;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Manual Login & Register DONEE
Route::post('/custom-registration_api', [CustomAuthController::class, 'customRegistration_api'])->name('register.custom_api');
Route::post('/custom-login_api', [CustomAuthController::class, 'customLogin_api'])->name('login.custom_api');
Route::post('/logout_api', [CustomAuthController::class, 'logout_api'])->name('login.logot_api');

// Get list barang
Route::get('/barangs_api', [BarangController::class, 'index_api'])->name('barangs_api');
Route::get('/barangs_api/{id}', [BarangController::class, 'detail_api'])->name('barangs_detail_api');

// Route pembelian (history) untuk user sendiri
Route::get('/orders_api/user/{id}', [PembelianController::class, 'order_user_api'])->name('orders.order_user_api');

// Route untuk tambah order

// Route::post('/orders/{user_id}/{id}/{jumlah}', [PembelianController::class, 'store_api'])->name('barangs.store_api'); //ORDER 1

Route::post('/orders', [PembelianController::class, 'store_api'])->name('barangs.store_api'); //ORDER > 1
Route::get('/orders/detail/{snap_token}', [PembelianController::class, 'detail'])->name('barangs.detail'); //ORDER > 1


// Update
Route::post('/orders/update_status/{id}', [PembelianController::class, 'update_status'])->name('barangs.update_status');

Route::post('/midtrans/notification', [handleNotification::class, 'index']);
