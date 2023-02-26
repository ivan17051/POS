<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PTMOU;
use Exception;

class PTMOUController extends Controller
{
    public function index(){
        $ptmou = PTMOU::all();
        return view('master.ptmou', ['ptmou'=>$ptmou]);
    }

    public function store(Request $request){
        try{
            $ptmou_baru = new PTMOU($request->all());
            $ptmou_baru->save();
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data PT MOU Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $ptmou = PTMOU::findOrFail($id);
            $ptmou->fill($request->all());
            $ptmou->save();
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data PT MOU Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $ptmou = PTMOU::findOrFail($id);
            $ptmou->delete();
        }catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data PT MOU Berhasil Dihapus');
        return back();
    }
}
