<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\STR;
use App\SIP;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Http\Requests\STRRequest;
use \Illuminate\Database\QueryException;
use Exception;

class STRController extends Controller
{
    public function index(){
        return view('str');
    }

    public function data(Request $request){
        if(Auth::user()->role=='Bidang'){
            $subquery = Pegawai::select('mpegawai.id','nik','nama','sip.expirystr', 'mpegawai.profesi', 'str.nomor as nomorstr','sip.nomor as nomorsip', DB::raw('@expirydiff := DATEDIFF(expiry, current_date) as expirydiff'),
                DB::raw("IF(sip.nomor IS NULL, -2, IF(@expirydiff<0, -1, IF(@expirydiff<60, 0, 1)) )  as validstatus, sip.namafaskes as faskes")
            )
            ->leftJoin('str', function($q){
                $q->on('str.idpegawai','=','mpegawai.id')->where('str.isactive', 1);
            })
            ->leftJoin('sip', function($join){
                $latestsip = SIP::select(DB::raw('max(id) as maxid'))->where('isactive', 1)->whereColumn('idpegawai', 'mpegawai.id')
                    ->where('sip.saranapraktik', 'PUSKESMAS')->where('expirystr','>','2019-12-31');
                $join->on('sip.idstr','=', 'str.id')
                    ->whereRaw("sip.id = ({$latestsip->toSql()})")
                    ->mergeBindings($latestsip->getQuery());
            });
        }
        else{
            $subquery = Pegawai::select('mpegawai.id','nik','nama','sip.expirystr', 'mpegawai.profesi', 'str.nomor as nomorstr','sip.nomor as nomorsip', DB::raw('@expirydiff := DATEDIFF(expiry, current_date) as expirydiff'),
                DB::raw("IF(sip.nomor IS NULL, -2, IF(@expirydiff<0, -1, IF(@expirydiff<60, 0, 1)) )  as validstatus")
            )
            ->leftJoin('str', function($q){
                $q->on('str.idpegawai','=','mpegawai.id')->where('str.isactive', 1);
            })
            ->leftJoin('sip', function($join){
                $latestsip = SIP::select(DB::raw('max(id) as maxid'))->where('isactive', 1)->whereColumn('idpegawai', 'mpegawai.id');
                $join->on('sip.idstr','=', 'str.id')
                    ->whereRaw("sip.id = ({$latestsip->toSql()})")
                    ->mergeBindings($latestsip->getQuery());
            });
        }
        
        $data = DB::table( DB::raw("({$subquery->toSql()}) as sub") )
            ->mergeBindings($subquery->getQuery())
            ->where('validstatus','<>',-2);

        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function show($id){
        $pegawai = Pegawai::findOrFail($id);
        $str = STR::where('idpegawai', $id)->get();
        return view('str', ['pegawai'=>$pegawai, 'str'=>$str]);
    }

    /*
     * Store STR
     */
    public function store(STRRequest $request){
        $userId = Auth::id();
        $input = $request->validated();
        
        DB::beginTransaction();
        try{
            $nakes = Pegawai::findOrFail($input['idpegawai']);

            $current = STR::where( 'idpegawai', $nakes->id )
                        ->where('isactive', 1)
                        ->orderBy('id','DESC')->first();
            
            // NON AKTIFKAN STR LAMA
            if($current){
                $current->isactive = false;
                $current->save();
            }

            $model = new STR();
            $model->fill($input);
            $model->fill([
                'nomorregis' => $nakes->nomorregis,
                'idprofesi' => $nakes->idprofesi,
                'idspesialisasi' => $nakes->idspesialisasi,
            ]);
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();

            // JIKA PERPANJANG SIP SEKALIAN
            if($current AND isset($input['isperpanjangsip']) AND $input['isperpanjangsip']){
                $sips=SIP::where('idstr', $current->id)->where('isactive', 1)->get();

                foreach ($sips as $sip) {
                    $newSIP = $sip->replicate();
                    $newSIP->fill([
                        'idstr' => $model->id,
                        'nomorstr' => $model->nomor,
                        'expirystr' => $model->expiry,
                        'iterator' => 1,
                        'jenispermohonan' => 'perpanjangan',
                        'idc'=> $userId,
                        'idm'=> $userId,
                    ]);
                    $newSIPs[] = $newSIP->toArray();
                    $sip->isactive=0;
                    $sip->tgldeactive=date('Y-m-d');
                    $sip->save();
                }
                SIP::insert($newSIPs);
            }
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch(Exception $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    /*
     * Update STR
     */
    public function update(STRRequest $request){
        $userId = Auth::id();
        $input = $request->validated();

        DB::beginTransaction();
        try{
            $model = STR::findOrFail($input['id']);
            $model->fill($input);
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
            $str = STR::findOrFail($id);
            if(!$str->isactive) throw new Exception("Unauthorized");
            $sips = SIP::where('idstr', $id)->get();
            
            foreach ($sips as $sip) {
                $sip->isactive=0;
                $sip->tgldeactive=date('Y-m-d');
                $sip->save();
            }
            
            $str->alasan = $request->alasan;
            $str->isactive = 0;
            $str->save();
            DB::commit();
            $this->flashSuccess('STR Berhasil Dinonaktifkan');
            return back();
        }catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }
}
