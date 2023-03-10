<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Exception;
use Datatables;

class BarangController extends Controller
{
    public function index(){
        return view('master.barang');
    }

    public function data(){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        $data = Barang::raw('select * from mbarang');
        
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);
        
        $datatable->addColumn('action', function ($t) { 
                return '<a href="" class="btn btn-info btn-link" style="padding:5px;" target="_blank" rel="noreferrer noopener"><i class="material-icons">launch</i></a>&nbsp'.
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button>';
            });
        
        return $datatable->make(true); 
    }

    public function store(Request $request){
        try{
            $barang_baru = new Barang($request->all());
            $barang_baru->save();
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Barang Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $barang = Barang::findOrFail($id);
            $barang->fill($request->all());
            $barang->save();
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Barang Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $barang = Barang::findOrFail($id);
            $barang->delete();
        }catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Barang Berhasil Dihapus');
        return back();
    }
}
