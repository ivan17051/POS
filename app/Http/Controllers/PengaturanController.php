<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengaturan;

class PengaturanController extends Controller
{
    public function index(){
        $min_belanja = Pengaturan::where('key','min_belanja')->first();
        
        return view('pengaturan', ['pengaturan'=>$min_belanja]);
    }

    public function store(Request $request){
        
        try{
            $min_belanja = Pengaturan::where('key','min_belanja')->first();
            $min_belanja->value = $request->min_belanja;
            $min_belanja->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Minimal Pembelanjaan Berhasil Diubah');
        return back();
    }
}
