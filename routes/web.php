<?php

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
Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    // index, store, show, update and destroy
    Route::apiResource('kategori', KategoriController::class)->except('show');
    Route::apiResource('barang', BarangController::class)->except('show');
    Route::apiResource('user', UserController::class)->except('show');
    
    Route::get('barang/data', 'BarangController@data')->name('barang.data');

    
});