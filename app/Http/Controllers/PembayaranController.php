<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\BarangMasuk;
use DB;

class PembayaranController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('master.kategori', ['kategori'=>$kategori]);
    }

    public function data($idbarangmasuk){
        $pembayaran = Pembayaran::where('idbarangmasuk',$idbarangmasuk)->get(['id','nokwitansi','tanggal','jumbayar']);
        return $pembayaran;
    }

    public function cekSisa($idbarangmasuk, $jumlah){
        $barang_masuk = BarangMasuk::findOrFail($idbarangmasuk);
        $pembayaran = Pembayaran::where('idbarangmasuk',$idbarangmasuk)->get(['jumlah']);
        $total = 0;
        foreach($pembayaran as $unit){
            $total += $pembayaran->jumlah;
        }
        if($barang_masuk->jumlah-$total <= $jumlah) return $barang_masuk->jumlah-$total-$jumlah;
        else return false;
    }

    public function store(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try{
            // $cek = cekSisa($request->idbarangmasuk, $request->jumlah);

            $barang_masuk = BarangMasuk::findOrFail($request->idbarangmasuk);
            $pembayaran = Pembayaran::where('idbarangmasuk',$request->idbarangmasuk)->get(['jumbayar']);
            $total = 0;
            
            foreach($pembayaran as $unit){
                $total += $unit->jumbayar;
            }
            
            if($barang_masuk->jumlah-$total > $request->jumbayar) {
                // $sisa = $barang_masuk->jumlah-$total-$request->jumbayar;

            } else if($barang_masuk->jumlah-$total == $request->jumbayar) {
                $barang_masuk->islunas = 1;
                $barang_masuk->save();
            } else {
                $this->flashError('Jumlah Pembayaran Melebihi Sisa Pembayaran');
                return back();
            }

            $pembayaran_baru = new Pembayaran($request->all());
            $pembayaran_baru->save();

        }catch(QueryException $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
        
        DB::commit();
        $this->flashSuccess('Data Pembayaran Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $kategori = Kategori::findOrFail($id);
            $kategori->fill($request->all());
            $kategori->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Kategori Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Kategori Berhasil Dihapus');
        return back();
    }
}
