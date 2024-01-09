<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\TransaksiController;
use App\Models\BarangMasuk;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/chart', [DashboardController::class, 'chart'])->name('chart');
Route::get('/dashboard/chartTransaksi', [DashboardController::class, 'chartTransaksi'])->name('chartTransaksi');

Route::get('/list', [BarangController::class, 'index'])->name('list');

Route::post('/list/store', [BarangController::class, 'store'])->name('store');
Route::post('/list/jenisInput', [BarangController::class, 'jenisInput'])->name('jenis');
Route::post('/list/update/{id}', [BarangController::class, 'update'])->name('update');
Route::post('/list/hapus/{id}', [BarangController::class, 'hapus'])->name('hapus');

Route::get('/masuk', [BarangMasukController::class, 'index'])->name('masuk');
Route::post('/tambah', [BarangMasukController::class, 'tambah'])->name('tambah');
Route::get('/historyMasuk', [BarangMasukController::class, 'history'])->name('historyMasuk');

Route::get('/keluar', [BarangKeluarController::class, 'index'])->name('keluar');
Route::post('/kurang', [BarangKeluarController::class, 'kurang'])->name('kurang');
Route::get('/historyKeluar', [BarangKeluarController::class, 'history'])->name('historyKeluar');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::post('/transaksi/keranjang', [TransaksiController::class, 'keranjang'])->name('keranjang');
Route::post('/transaksi/simpan', [TransaksiController::class, 'simpan'])->name('simpan');
Route::get('/history', [TransaksiController::class, 'history'])->name('history');
Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'hapus'])->name('transaksi.hapus');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register/create', [RegisterController::class, 'create'])->name('register.create');
