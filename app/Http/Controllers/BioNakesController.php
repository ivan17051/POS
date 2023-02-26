<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\STR;
use App\SIP;
use App\Pejabat;
use App\JenisPermohonan;
use App\Faskes;
use App\Berakhir;
use App\PTMOU;
use App\Surket;

class BioNakesController extends Controller
{
    public function index(Request $request){
        $idstrlawas = $request->get('idstrlawas');

        $idnakes = $request->get('nakes');
        $d['nakes']= isset($idnakes) ? Pegawai::where('id',$idnakes)->with('profesirelation')->first() : null;
        $d['urlparam']=null;
        $d['makssip']=0;
        $d['puskesmas']=Faskes::where('nama','LIKE','Puskesmas%')->get();
        $d['ptmou']=PTMOU::all();
        $d['profesi'] = Profesi::get(['id','nama']);

        if(isset($d['nakes'])){
            $d['makssip']=$d['nakes']->profesirelation->makssip;
            $d['berakhir']=Berakhir::where('idprofesi', $d['nakes']->idprofesi)->get();

            if(isset($idstrlawas)){
                $d['str']=STR::where('idpegawai', $idnakes)->where('id', $idstrlawas)->first();
            }else{
                $d['str']=STR::where('idpegawai', $idnakes)->with('berakhir')->orderBy('id','DESC')->first();
            }
            
            $d['urlparam'] ="?nakes={$idnakes}";
            $d['staf'] = Pejabat::where('jabatan','Staf')->get();
            $d['jenispermohonan'] = JenisPermohonan::where('idprofesi',$d['nakes']->idprofesi)->get();
        }
        
        if (isset($d['str'])) {
            for($i=0;$i<$d['makssip'];$i++){
                $d['sips'][$i]=SIP::where('idstr', $d['str']->id)->where('instance',$i+1)->orderBy('iterator', 'desc')->first();
            }
            // $d['sips']=SIP::where('idstr', $d['str']->id)->where('isactive',1)->orderBy('instance')->get()->toArray();
            $d['surket']=Surket::where('idpegawai',$idnakes)->where('idstr',$d['str']->id)->orderBy('tglsurat', 'asc')->first();
            $d['idsip']=isset($d['surket']) ? explode(',',$d['surket']->idsip) : [];
        }else{
            $d['sips'] = [];
            $d['surket'] = [];
        }
        // dd($d);
        return view('bio', $d);
    }

    public function searchPegawai(Request $request){
        try{
            $data = Pegawai::where('idprofesi',$request->idprofesi)->where('nomorregis',$request->nomorregis)->first(['id']);
            
        }catch(Exception $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        if(!isset($data)){
            $this->flashError('Data Tidak Ditemukan');
            return back();
        }
        $this->flashSuccess('Data Berhasil Ditemukan');
        return redirect('bio?nakes='.$data->id);
    }

    public function rawBio(Request $request){
        $idnakes = $request->get('nakes');
        $d['nakes']=Pegawai::find($idnakes);
        $d['str']=STR::where('idpegawai', $idnakes)->orderBy('id','DESC')->first();
        return view('raw.bio', $d);
    }

    public function rawHistoristr(Request $request){
        $idnakes = $request->get('nakes');
        $idstr = $request->get('idstr');
        $str = STR::where('idpegawai', $idnakes)->with('profesi')->orderBy('id', 'desc')
            ->select('id','idprofesi', 'nomor', 'since', 'expiry')->get();        
        // SELECTED ID STR YANG DITAMPILKAN PADA HISTORI
        if(!isset($idstr) AND $str->isNotEmpty()) $idstr=$str[0]->id;
        $urlparam ="?nakes={$idnakes}";
        return view('raw.historistr', ['str'=>$str, 'idstr'=>$idstr, 'urlparam'=>$urlparam]);
    }

    public function rawHistorisip(Request $request, $index){
        $idnakes = $request->get('nakes');
        $idstr = $request->get('idstr');
        $sip = SIP::where('idpegawai', $idnakes)->where('instance', $index)
            // ->where('idstr',$idstr)
            ->orderBy('id', 'desc')->get();
        
        // for($x=0;$x<=count($sip);$x++){
        //     if($sip[$x]['jenispermohonan']=='perpanjangan'){
                
        //     }
        // }
        // dd($sip);

        return view('raw.historisip', ['sip'=>$sip, 'strnow'=>$idstr]);
    }
    public function rawHistoriSurket(Request $request){
        $surket = Surket::where('idpegawai', $request->idnakes)->orderBy('id', 'desc')
            ->get();
        
        return view('raw.historisurket', ['surket'=>$surket]);
    }
}
