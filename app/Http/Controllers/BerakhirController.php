<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berakhir;
use App\Profesi;

class BerakhirController extends Controller
{
    public function index(){
        $berakhir = Berakhir::with('profesi')->get();
        // Get profesi PPDS, PPDGS, Intern aja
        $profesi = Profesi::select('id', 'nama')->whereIn('id',[5,6,7])->get();
        
        return view('master.berakhir', ['berakhir'=>$berakhir, 'profesi'=>$profesi]);
    }

    public function store(Request $request){
        try{
            $berakhir_baru = new Berakhir($request->all());
            $berakhir_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berakhir Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $profesi = Berakhir::findOrFail($id);
            $profesi->fill($request->all());
            $profesi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Berakhir Berhasil Diubah');
        return back();
    }

    public function destroy($id){
        try {
            $berakhir = Berakhir::findOrFail($id);
            $berakhir->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berakhir Berhasil Dihapus');
        return back();
    }
}
