<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('master.kategori', ['kategori'=>$kategori]);
    }

    public function store(Request $request){
        try{
            $kategori_baru = new Kategori($request->all());
            // dd($request->all(),$kategori_baru);
            $kategori_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Kategori Berhasil Ditambahkan');
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
