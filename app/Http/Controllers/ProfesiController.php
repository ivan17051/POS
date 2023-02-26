<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Profesi;
use App\Spesialisasi;
use App\Pegawai;

class ProfesiController extends Controller
{
    public function index(){
        $profesi = Profesi::join('vw_agregatnakesbyprofesi', 'mprofesi.id', '=', 'vw_agregatnakesbyprofesi.idprofesi')->get();
        
        return view('master.profesi', ['profesi'=>$profesi]);
    }

    public function store(Request $request){
        try{
            $profesi_baru = new Profesi($request->all());
            if(!isset($profesi_baru->isparent)) $profesi_baru->isparent=0;
            $profesi_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Profesi Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $profesi = Profesi::findOrFail($id);
            $profesi->fill($request->all());
            if($profesi->isparent!='on') $profesi->isparent=0;
            else $profesi->isparent=1;
            $profesi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Profesi Berhasil Diubah');
        return back();
    }

    public function destroy($id){
        try {
            $profesi = Profesi::findOrFail($id);
            $profesi->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Profesi Berhasil Dihapus');
        return back();
    }

    public function getspesialisasi($id){
        try{
            $data = Spesialisasi::where('idprofesi', $id)->get()->toArray();
            $ids = [];
            foreach($data as $unit){
                array_push($ids, $unit['id']);
            }
            $count = Pegawai::select('idspesialisasi', DB::raw('count(id) as total'))
                ->whereIn('idspesialisasi', $ids)->groupBy('idspesialisasi')->get()->toArray();
            
            for($x=0;$x<count($data);$x++){
                for($y=0;$y<count($count);$y++){
                    if($data[$x]['id']==$count[$y]['idspesialisasi']){
                        $data[$x]['total'] = $count[$y]['total'];
                    }
                    
                }
            }
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        return $data;
    }

    public function storeSpesialisasi(Request $request){
        try{
            $spesialisasi_baru = new Spesialisasi($request->all());
            $spesialisasi_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Spesialisasi Berhasil Ditambahkan');
        return back();
    }

    public function updateSpesialisasi(Request $request, $id){
        try{
            $spesialisasi = Spesialisasi::findOrFail($id);
            $spesialisasi->fill($request->all());
            $spesialisasi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Spesialisasi Berhasil Diubah');
        return back();
    }

    public function destroySpesialisasi($id){
        try {
            $spesialisasi = Spesialisasi::findOrFail($id);
            $spesialisasi->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Spesialisasi Berhasil Dihapus');
        return back();
    }
}
