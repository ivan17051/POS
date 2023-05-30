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
    Route::apiResource('pembayaran', PembayaranController::class)->only('store','update');

    Route::post('/barang/data', 'BarangController@data')->name('barang.data');
    Route::get('/barang/checkkode/{kode}', 'BarangController@checkKode')->name('barang.check');
    Route::get('/member/riwayat/{id}', 'MemberController@riwayat')->name('member.riwayat');
    
    Route::post('/barang_masuk/data', 'BarangMasukController@data')->name('barang_masuk.data');
    Route::get('/barang_masuk/detail/{nomor}', 'BarangMasukController@detail')->name('barang_masuk.detail');
    Route::get('/barang_masuk/cetak/{id}', 'BarangMasukController@cetak')->name('barang_masuk.cetak');
    
    Route::get('/pembayaran/{id}', 'PembayaranController@data')->name('pembayaran.data');
    
    Route::post('/barang_keluar/data', 'BarangKeluarController@data')->name('barang_keluar.data');
    Route::get('/barang_keluar/detail/{id}', 'BarangKeluarController@detail')->name('barang_keluar.detail');

    Route::get('/pembelian/getbarang', 'DataController@getBarang')->name('data.searchbarang');
    Route::get('/pembelian/getmember', 'DataController@getMember')->name('data.searchmember');
    Route::get('/pembelian', 'BarangKeluarController@pembelian')->name('barang.pembelian');
    Route::post('/pembelian', 'BarangKeluarController@store')->name('barang_keluar.store');
    
    Route::get('/stok', 'StokController@index')->name('stok.index');
    Route::post('stok/data', 'StokController@data')->name('stok.data');

    Route::get('/data/laporan', 'DataController@laporan');
    Route::post('/data/laporan', 'DataController@downloadLaporan')->name('data.download');

    Route::get('/pengaturan', 'PengaturanController@index')->name('pengaturan.index');
    Route::post('/pengaturan', 'PengaturanController@store')->name('pengaturan.store');

    Route::get('/cetak/barcode/{kode}', 'CetakController@barcode')->name('cetak.barcode');
    
    Route::get('/customer_view', function(){
        return view('transaksi.customer_view');
    });
});
