<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Barang;
use App\BarangKeluar;

class BarangKeluarController extends Controller
{
    //index, create, store, show, edit, update and destroy
    public function index(){
        $barang = Barang::get(['id','namabarang']);
        
        return view('transaksi.barang_masuk', ['barang'=>$barang]);
    }

    public function data(){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = BarangMasuk::with('getBarang');
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);
        
        $datatable->addColumn('action', function ($t) { 
                return 
                // '<a href="" class="btn btn-info btn-link" style="padding:5px;" target="_blank" rel="noreferrer noopener"><i class="material-icons">launch</i></a>&nbsp'.
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus('.$t->id.')"><i class="material-icons">delete</i></button>';
            });
        
        return $datatable->make(true); 
    }

    public function store(Request $request){
        try{
            $barang_masuk = new BarangMasuk($request->all());
            // dd($barang_masuk, $request->all());
            $barang_masuk->save();
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Barang Masuk Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $barang_masuk = BarangMasuk::findOrFail($id);
            $barang_masuk->fill($request->all());
            $barang_masuk->save();
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Barang Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $barang_masuk = BarangMasuk::findOrFail($id);
            $barang_masuk->delete();
        }catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Barang Masuk Berhasil Dihapus');
        return back();
    }

    // PEMBELIAN
    public function pembelian(){
        return view('transaksi.pembelian');
    }

    public function dataPembelian(){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = Barang::with('getKategori');
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);
        
        $datatable->addColumn('action', function ($t) { 
                return '<button type="button" class="btn btn-info btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">add_circle</i></button>';
            });
        
        return $datatable->make(true); 
    }
}
