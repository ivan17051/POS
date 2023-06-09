<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stok;
use App\StokOpname;
use App\Barang;
use Datatables;

class StokOpnameController extends Controller
{
    public function index(){
        $barang = Barang::leftJoin('stok','mbarang.id','stok.idbarang')
            ->groupBy('idbarang','namabarang')->selectRaw('idbarang, namabarang, sum(stok) as stok')->get();
        
        return view('stokopname.stokopname',['barang'=>$barang]);
    }

    public function data(){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = StokOpname::with('getBarang:id,namabarang,kodebarang')->get();
        $datatable = Datatables::of($data);
        
        return $datatable->make(true); 
    }

    public function store(Request $request){
        try{
            $supplier_baru = new Supplier($request->all());
            $supplier_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Supplier Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $supplier = Supplier::findOrFail($id);
            $supplier->fill($request->all());
            $supplier->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Supplier Berhasil Diubah');
        return back();
    }
}
