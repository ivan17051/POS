<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function index(){
        $supplier = Supplier::all();
        return view('master.supplier', ['supplier'=>$supplier]);
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

    public function destroy(Request $request, $id){
        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Supplier Berhasil Dihapus');
        return back();
    }
}
