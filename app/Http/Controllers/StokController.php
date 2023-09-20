<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Stok;
use Datatables;
use DB;

class StokController extends Controller
{
    public function index(){
        $supplier = Supplier::all();
        return view('stok', ['supplier'=>$supplier]);
    }

    public function data(){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        // $data = Stok::with('getSupplier:id,nama','getBarang:id,namabarang');
        $data = DB::select(DB::raw('SELECT A.*, B.nama AS namasupplier, C.namabarang AS namabarang 
            FROM stok A 
            LEFT JOIN msupplier B ON A.idsupplier = B.id
            LEFT JOIN mbarang C ON A.idbarang = C.id'));
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
