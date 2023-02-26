<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pejabat;

class PejabatController extends Controller
{
    public function index(){
        $pejabat = Pejabat::where('isactive',1)->get();
        return view('master.pejabat', ['pejabat'=>$pejabat]);
    }

    public function store(Request $request){
        try{
            $pejabat_baru = new Pejabat($request->all());
            $pejabat_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Pejabat Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $pejabat = Pejabat::findOrFail($id);
            $pejabat->fill($request->all());
            $pejabat->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Pejabat Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $pejabat = Pejabat::findOrFail($id);
            $pejabat->isactive = 0;
            $pejabat->save();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Pejabat Berhasil Dihapus');
        return back();
    }
}
