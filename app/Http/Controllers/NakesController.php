<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\STR;
use App\SIP;
use App\Spesialisasi;
use Datatables;
use Validator;
use App\Http\Requests\NakesProfileRequest;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;
use Exception;

class NakesController extends Controller
{
    public function pegawai(){
        $d['profesi'] = Profesi::all();
        return view('nakes', $d);
    }

    public function pegawaiData(Request $request){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        if(Auth::user()->role=="Bidang"){
            $listPegawai = SIP::where('saranapraktik','PUSKESMAS')->groupBy('idpegawai')->get(['idpegawai'])->toArray();
            $data = Pegawai::raw('select * from mpegawai')->whereIn('id',$listPegawai);
        }
        else{
            $data = Pegawai::raw('select * from mpegawai');
        }
        
        // $data = Pegawai::all();
        // $maks = Pegawai::max('nomorregis');
        // $cek = [];
        // $data = Pegawai::select('nomorregis')->get();
        // for($i=0;$i<=$maks;$i++){
        //     foreach($data as $unit)
        //     if($data[$i]['nomorregis']!=$i)
        //     array_push($cek, $i);
        // }

        // dd($maks, $cek);
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);
        
        $datatable->addColumn('action', function ($t) { 
                return '<a href="'.route('bio').'?nakes='.$t->id.'" class="btn btn-info btn-link" style="padding:5px;" target="_blank" rel="noreferrer noopener"><i class="material-icons">launch</i></a>&nbsp'.
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button>';
            });
        
        return $datatable->make(true); 
    }
    /*
     * Store Pegawai
     */
    public function storePegawai(NakesProfileRequest $request){
        $input = $request->validated();
        removeNull($input);
        $userId = Auth::id();

        DB::beginTransaction();
        try{
            $profesi = Profesi::find($input['idprofesi']);
            if(!$profesi->isparent){
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => NULL,
                    'spesialisasi' => NULL,
                ];
            }else{
                $spesialisasi = Spesialisasi::find($input['idspesialisasi']);
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => $spesialisasi->id,
                    'spesialisasi' => $spesialisasi->nama,
                ];
            }            

            if(!isset($input['nomorregis'])){
                $input['nomorregis'] = NULL;        //will automatically set by trigger
            }
        
            $model = new Pegawai();
            $model->fill($input);
            $model->fill($profesiinfo);
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch (Exception $e) {
            DB::rollback();
            $this->flashError('Error: '.$e->getMessage());
            return back();
            // return response()->json($e->getMessage(), 400);
        }
    }

    /*
     * Update Pegawai
     */
    public function updatePegawai(NakesProfileRequest $request){
        $input = $request->validated();
        removeNull($input);
        $userId = Auth::id();

        DB::beginTransaction();
        try{
            if(isset($input['idprofesi'])){
                $profesi = Profesi::find($input['idprofesi']);
                if(!$profesi->isparent){
                    $profesiinfo = [
                        'kodeprofesi' => $profesi->kode,
                        'profesi' => $profesi->nama,
                        'idspesialisasi' => NULL,
                        'spesialisasi' => NULL,
                    ];
                }else{
                    $spesialisasi = Spesialisasi::find($input['idspesialisasi']);
                    $profesiinfo = [
                        'kodeprofesi' => $profesi->kode,
                        'profesi' => $profesi->nama,
                        'idspesialisasi' => $spesialisasi->id,
                        'spesialisasi' => $spesialisasi->nama,
                    ];
                }
            }

            $model = Pegawai::findOrFail($input['id']);
            if(isset($input['idprofesi'])){
            // jika ganti profesi, mengganti nomorregis juga ke MAX
                if( $model->idprofesi <> $input['idprofesi']){
                    $idmax = Pegawai::select( DB::raw("coalesce(MAX(nomorregis)+1 , 1) idmax"))->where('idprofesi',$input['idprofesi'])->pluck('idmax')->first();

                    $input['nomorregis'] = $idmax;
                }
            }

            $model->fill($input);
            if(isset($profesiinfo)) $model->fill($profesiinfo);
            $model->idm = $userId;    
            $model->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch (Exception $e) {
            DB::rollback();
            if(isset($e->errorInfo) AND $e->errorInfo[0] == 23000){
                $this->flashError("Nomor regis {$model['nomorregis']} sudah terpakai");    
            }else{
                $this->flashError($e->getMessage());
            }
            return back();
        }
    }

    public function deletePegawai($id){
        DB::beginTransaction();
        try {
            $pegawai = Pegawai::findOrFail($id);
            $str = STR::where('idpegawai', $id)->get();
            $sip = SIP::where('idpegawai', $id)->get();
            $pegawai->delete();
            
            foreach($str as $unit){
                $unit->delete();
            }
            foreach($sip as $unit){
                $unit->delete();
            }
            
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }
        DB::commit();

        $this->flashSuccess('Data Berhasil Dihapus');
        return back();
    }
}
