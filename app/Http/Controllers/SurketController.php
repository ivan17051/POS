<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Surket;
use Auth;
use DB;

class SurketController extends Controller
{
    public function store(Request $request){
        $userId = Auth::id();
        DB::beginTransaction();
        try{
            $model = new Surket();
            $model->fill($request->all());
            $model->fill([
                'idpegawai' => $request->idpegawai,
                'idstr' => isset($request->idstr) ? $request->idstr : '',
                'idsip' => isset($request->idsip) ? $request->idsip : '',
            ]);
            $model->idc = $userId;
            $model->idm = $userId;
            
            $model->save();
            
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch(Exception $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    public function update(Request $request){
        $userId = Auth::id();
        
        DB::beginTransaction();
        try{
            $model = Surket::findOrFail($request->id);
            $model->fill($request->all());
            $model->save();
            DB::commit();
            return response()->json(['message'=>'Berhasil Memperbarui Data'], 200);
        }catch(Exception $exception){
            DB::rollBack();
            return response()->json($exception->getMessage(), 200);
        }
    }

}
