<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');



use App\Http\Controllers\ProdukController;
Route::resource('produks', ProdukController::class);

use App\Http\Controllers\PelangganController;
Route::resource('pelanggans', PelangganController::class);
Route::get('/pelanggan/search', [PelangganController::class, 'search'])->name('pelanggan.search');


use App\Http\Controllers\PenjualanController;
Route::resource('penjualans', PenjualanController::class);


use App\Http\Controllers\KategoriController;
Route::resource('kategoris', KategoriController::class);

use App\Http\Controllers\SupplierController;
Route::resource('suppliers', SupplierController::class);

use App\Http\Controllers\StockController;
Route::resource('stocks', StockController::class);


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
 

use App\Http\Controllers\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/', function () {
    return view('landing');
});


Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


use App\Http\Controllers\LaporanPenjualanController;

Route::get('/laporan-penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan.penjualan');
Route::get('/laporan-penjualan/cetak', [LaporanPenjualanController::class, 'cetakPdf'])->name('laporan.penjualan.pdf');

use App\Http\Controllers\Auth\RegisterController;

Route::post('/register', [RegisterController::class, 'register'])->name('register');

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

});

// Route untuk Kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
    Route::get('/kasir/penjualans', [PenjualanController::class, 'index'])->name('kasir.penjualan');
    Route::post('/kasir/logout', [KasirController::class, 'logout'])->name('kasir.logout');

});

