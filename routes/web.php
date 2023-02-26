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
    Route::get('/', 'DashboardController@awal');
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/str', 'STRController@index');
    Route::post('/str/data', 'STRController@data')->name('data');

    // index, create, store, show, edit, update and destroy
    Route::resource('str', STRController::class)->only(['show','store','update','destroy']);
    Route::resource('sip', SIPController::class)->only(['show','store','update','destroy']);
    
    // index, store, show, update and destroy
    Route::apiResource('surket', SurketController::class)->except('index');
    Route::apiResource('nib', NIBController::class)->except('index');
    Route::apiResource('berakhir', BerakhirController::class)->except('show');
    Route::apiResource('user', UserController::class)->except('show');
    Route::apiResource('kategori', KategoriController::class)->except('show');
    Route::apiResource('pejabat', PejabatController::class)->except('show');
    Route::apiResource('ptmou', PTMOUController::class)->except('show');


    Route::get('/nakes', 'NakesController@pegawai');
    Route::post('/nakes/data', 'NakesController@pegawaiData')->name('nakes.data');
    Route::post('/nakes', 'NakesController@storePegawai')->name('nakes.store');
    Route::put('/nakes', 'NakesController@updatePegawai')->name('nakes.update');
    Route::delete('/nakes/{id}', 'NakesController@deletePegawai')->name('nakes.delete');

    Route::post('/faskes/data', 'FaskesController@data')->name('faskes.data');
    Route::post('/faskes/dataMandiri', 'FaskesController@dataMandiri')->name('faskes.dataMandiri');
    Route::get('/faskes/map', 'FaskesController@map')->name('faskes.map');
    Route::apiResource('faskes', FaskesController::class);
    Route::get('/faskesMandiri', 'FaskesController@indexMandiri')->name('faskesMandiri.index');
    Route::get('getpegawai/{id}', 'FaskesController@getpegawai')->name('pegawai.get');

    Route::resource('profesi', ProfesiController::class)->only(['index','store','update','destroy']);
    Route::get('getspesialisasi/{id}', 'ProfesiController@getspesialisasi')->name('spesialisasi.get');
    Route::put('putspesialisasi/{id}', 'ProfesiController@updateSpesialisasi')->name('spesialisasi.update');
    Route::post('storespesialisasi', 'ProfesiController@storeSpesialisasi')->name('spesialisasi.store');
    Route::delete('destroypesialisasi/{id}', 'ProfesiController@destroySpesialisasi')->name('spesialisasi.destroy');

    Route::get('/bio', 'BioNakesController@index')->name('bio');
    Route::post('/bio', 'BioNakesController@searchPegawai')->name('bio.searchPegawai');

    Route::get('/raw/bio', 'BioNakesController@rawBio')->name('raw.bio');
    Route::get('/raw/historistr', 'BioNakesController@rawHistoristr')->name('raw.historistr');
    Route::get('/raw/historisip/{index}', 'BioNakesController@rawHistorisip')->name('raw.historisip');
    Route::get('/raw/historinib', 'FaskesController@rawHistorinib')->name('raw.historinib');
    Route::get('/raw/historisurket', 'BioNakesController@rawHistoriSurket')->name('raw.historisurket');

    Route::get('/data/getspesialisasi/{idprofesi}', 'DataController@getSpesialisasi')->name('data.getspesialisasi');
    Route::get('/data/searchfaskes', 'DataController@searchFaskes')->name('data.searchfaskes');
    Route::get('/data/searchpegawai', 'DataController@searchPegawai')->name('data.searchpegawai');
    Route::get('/data/laporan', 'DataController@laporan');
    Route::post('/data/laporan', 'DataController@downloadLaporan')->name('data.download');

    Route::get('/cetak/perstek/{idsip}', 'CetakController@perstek')->name('cetak.perstek');
    Route::get('/cetak/kitir/{idsip}', 'CetakController@kitir')->name('cetak.kitir');
    Route::get('/cetak/sip/{idsip}', 'CetakController@sip')->name('cetak.sip');
    Route::get('/cetak/surket/{idsurket}', 'CetakController@surket')->name('cetak.surket');
    
    Route::put('/profil/update', 'PegawaiController@update')->middleware('auth')->name('profil.update');
    Route::post('/profil/upload', 'PegawaiController@upload')->name('profil.upload');
    Route::delete('/profil/delete/{idpegawai}', 'PegawaiController@deleteFoto')->name('profil.hapus');

    Route::post('/sip/uploadFotoPendukung', 'SIPController@uploadFotoPendukung')->name('sip.uploadFotoPendukung');
});
