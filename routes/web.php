<?php

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
    Route::get('/', 'DashboardController@index');

    // index, create, store, show, edit, update and destroy
    Route::resource('barang_masuk', BarangMasukController::class);
    Route::resource('barang_keluar', BarangKeluarController::class);
    
    // index, store, show, update and destroy
    Route::apiResource('kategori', KategoriController::class)->except('show');
    Route::apiResource('barang', BarangController::class)->except('show');
    Route::apiResource('user', UserController::class)->except('show');
    Route::apiResource('member', MemberController::class);
    Route::apiResource('supplier', SupplierController::class)->except('show');

    Route::post('/barang/data', 'BarangController@data')->name('barang.data');
    Route::post('/barang_masuk/data', 'BarangMasukController@data')->name('barang_masuk.data');
    Route::get('/barang_masuk/detail/{nomor}', 'BarangMasukController@detail')->name('barang_masuk.detail');

    Route::get('/stok', 'StokController@index')->name('stok.index');
    Route::post('stok/data', 'StokController@data')->name('stok.data');

    Route::get('/pembelian/data', 'BarangKeluarController@dataBarang')->name('data.searchbarang');
    Route::get('/pembelian', 'BarangKeluarController@pembelian')->name('barang.pembelian');
    
    Route::get('/raw/bio', 'BioNakesController@rawBio')->name('raw.bio');
    Route::get('/raw/historistr', 'BioNakesController@rawHistoristr')->name('raw.historistr');
    Route::get('/raw/historisip/{index}', 'BioNakesController@rawHistorisip')->name('raw.historisip');
    Route::get('/raw/historinib', 'FaskesController@rawHistorinib')->name('raw.historinib');
    Route::get('/raw/historisurket', 'BioNakesController@rawHistoriSurket')->name('raw.historisurket');

    Route::get('/data/laporan', 'DataController@laporan');
    Route::post('/data/laporan', 'DataController@downloadLaporan')->name('data.download');

    Route::get('/cetak/perstek/{idsip}', 'CetakController@perstek')->name('cetak.perstek');
    Route::get('/cetak/kitir/{idsip}', 'CetakController@kitir')->name('cetak.kitir');
    
    Route::get('/customer_view', function(){
        return view('transaksi.customer_view');
    });
});
