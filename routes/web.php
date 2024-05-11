<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankDarahController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('/login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/infoakun', [AuthController::class, 'infoakun'])->name('infoakun');


Route::get('/dashboard', [DashboardController::class, 'Index'])->name('dashboard');
Route::post('/ambil_progres_pemakaian_darah', [DashboardController::class, 'ambilProgresPemakaianDarah'])->name('ambil_progres_pemakaian_darah');
Route::post('/ambil_grafik', [DashboardController::class, 'ambilGraffikPemakaian'])->name('ambil_grafik');


Route::get('/datapemakaian', [BankDarahController::class, 'indexDataPemakaian'])->name('datapemakaian');
Route::get('/datastokdarah', [BankDarahController::class, 'indexDataStokDarah'])->name('datastokdarah');
Route::post('/datastokdarah', [BankDarahController::class, 'simpanStokDarah'])->name('simpanstokdarah');
Route::post('/ambilstokdarah', [BankDarahController::class, 'ambilStokDarah'])->name('ambilstokdarah');
Route::post('/ambilstokdarahpemakaian', [BankDarahController::class, 'ambilStokDarahPemakaian'])->name('ambilstokdarahpemakaian');
Route::post('/simpanpemakaiandarah', [BankDarahController::class, 'simpanPemakaianDarah'])->name('simpanpemakaiandarah');
Route::post('/ambildatapemakaian', [BankDarahController::class, 'ambilDataPemakaian'])->name('ambildatapemakaian');
Route::post('/detailstok', [BankDarahController::class, 'detailStok'])->name('detailstok');
Route::post('/simpaneditstok', [BankDarahController::class, 'simpanEditStok'])->name('simpaneditstok');
Route::post('/hapusstok', [BankDarahController::class, 'hapusStok'])->name('hapusstok');
Route::post('/batalpemakaian', [BankDarahController::class, 'batalPemakaian'])->name('batalpemakaian');
Route::post('/detailpemakaiandarah', [BankDarahController::class, 'detailPemakaianDarah'])->name('detailpemakaiandarah');
Route::post('/returpemakaian', [BankDarahController::class, 'returPemakaian'])->name('returpemakaian');

Route::get('/datauser', [BankDarahController::class, 'indexDataUser'])->name('datauser');
Route::post('/ambildatauser', [BankDarahController::class, 'ambilDataUser'])->name('ambildatauser');
Route::post('/formedituser', [BankDarahController::class, 'formEditUser'])->name('formedituser');
Route::post('/simpanedituser', [BankDarahController::class, 'simpanEditUser'])->name('simpanedituser');
