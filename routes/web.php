<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PasokController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenjualanController;
use App\Models\Distributor;
use App\Http\Controllers\DashboardController;
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
    return view('welcome');
});
// Route::middleware(['auth','roleAuth'])->group(function() {
    Route::get('admin/dashboard', [DashboardController::class,'admin'] );
    Route::get('kasir/dashboard', [DashboardController::class,'kasir'] );
    Route::prefix('buku')->group(function (){
        Route::get('', [BukuController::class,'index'] );
        Route::get('/create', [BukuController::class,'create'] );
        Route::post('/', [BukuController::class,'store'] );
        Route::get('/{id}', [BukuController::class,'edit'] );
        Route::get('/show/{id}', [BukuController::class,'show'] );
        Route::post('/update', [BukuController::class,'update'] );;
        Route::post('/delete/{id}', [BukuController::class,'delete'] );
    });
    Route::prefix('distributor')->group(function (){
        Route::get('', [DistributorController::class,'index'] );
        Route::get('/create', [DistributorController::class,'create'] );
        Route::post('/', [DistributorController::class,'store'] );
        Route::get('/{id}', [DistributorController::class,'edit'] );
        Route::get('/show/{id}', [DistributorController::class,'show'] );
        Route::post('/update', [DistributorController::class,'update'] );
        Route::post('/delete/{id}', [DistributorController::class,'delete'] );
    });
    Route::prefix('pasok')->group(function (){
        Route::get('', [PasokController::class,'index'] );
        Route::get('/create', [PasokController::class,'create'] );
        Route::post('/', [PasokController::class,'store'] );
        Route::get('/show/{id}', [PasokController::class,'show'] );
        Route::get('/pdf/{id}', [PasokController::class,'pdf'] );
        Route::post('/delete/{id}', [PasokController::class,'delete'] );
    });
    Route::prefix('penjualan')->group(function (){
        Route::get('', [PenjualanController::class,'index'] );
        Route::get('/create', [PenjualanController::class,'create'] );
        Route::post('/', [PenjualanController::class,'store'] );
        Route::post('/bayar', [PenjualanController::class,'bayar'] );
        Route::get('/show/{id}', [PenjualanController::class,'show'] );
        Route::get('/pdf/{id}', [PenjualanController::class,'pdf'] );
        Route::post('/delete/{id}', [PenjualanController::class,'delete'] );
        Route::get('/ambilHarga',[PenjualanController::class,'ambilHarga']);
    });
    Route::prefix('laporan')->group(function (){
        Route::get('', [LaporanController::class,'index'] );
        Route::get('pdf/{from}/{to}', [LaporanController::class,'pdf'] );
    });
    Route::prefix('pengguna')->group(function (){
        Route::get('', [PenggunaController::class,'index'] );
        Route::get('/create', [PenggunaController::class,'create'] );
        Route::post('/', [PenggunaController::class,'store'] );
        Route::get('/{id}', [PenggunaController::class,'edit'] );
        Route::get('/show/{id}', [PenggunaController::class,'show'] );
        Route::post('/update', [PenggunaController::class,'update'] );
        Route::post('/delete/{id}', [PenggunaController::class,'delete'] );
        Route::get('/reset/{id}', [PenggunaController::class,'reset'] );
    });
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
