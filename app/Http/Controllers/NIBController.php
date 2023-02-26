<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faskes;
use App\NIB;
use Auth;
use DB;

class NIBController extends Controller
{
    public function store(Request $request){
        $userId = Auth::id();
        // dd($request->all());
        DB::beginTransaction();
        try{
            $faskes = Faskes::findOrFail($request->idfaskes);

            $current = NIB::where('idfaskes', $faskes->id )
                        ->where('isactive', 1)
                        ->orderBy('id','DESC')->first();
            
            // NON AKTIFKAN STR LAMA
            if($current){
                $current->isactive = false;
                $current->save();
            }

            $model = new NIB();
            $model->fill($request->all());
            $model->fill([
                'jenis' => isset ($request->aksinib) ? $request->aksinib : 'baru',
                'idkategori' => $faskes->idkategori,
                'isactive' => 1,
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
            $model = NIB::findOrFail($request->id);
            $model->fill($request->all());
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();
            DB::commit();
            return response()->json(['message'=>'Berhasil Memperbarui Data'], 200);
        }catch(Exception $exception){
            DB::rollBack();
            return response()->json($exception->getMessage(), 200);
        }
    }

    public function destroy($id, Request $request){
        DB::beginTransaction();
        try {
            $nib = NIB::findOrFail($id);
            if(!$nib->isactive) throw new Exception("Unauthorized");
            
            $nib->isactive = 0;
            $nib->save();
            DB::commit();
            $this->flashSuccess('NIB Berhasil Dinonaktifkan');
            return back();
        }catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }
}
