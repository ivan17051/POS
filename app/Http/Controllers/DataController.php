<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Spesialisasi;
use App\Pegawai;
use App\Faskes;
use App\Profesi;
use App\SIP;
use App\STR;
use App\Surket;
use DB;
use Datatables;
use Validator;

class DataController extends Controller
{
    public function getSpesialisasi($idprofesi){
        $spesialisasi = Spesialisasi::where('idprofesi',$idprofesi)->get();
        return response()->json($spesialisasi, 200);
    }

    public function searchFaskes(Request $request){
        $data=$request->input('query');
        $data = Faskes::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('alamat', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(10)
            ->get();
        return response()->json($data);
    }

    public function searchPegawai(Request $request){
        $data=$request->input('query');
        $data = Pegawai::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('nip', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(5)
            ->get();
        return response()->json($data);
    }

    public function laporan(){
        if(Auth::user()->role=='Bidang'){
            $d['fasyankes']=Faskes::where('idkategori',1)->get();
        }
        else{
            $d['fasyankes']=Faskes::select('id','nama')->get();
        }
        $d['profesi']=Profesi::select('id','nama')->get();
        $d['profesiman']=SIP::where('isactive',1)->where('saranapraktik','PRAKTIK MANDIRI')
            ->groupBy('idprofesi','mprofesi.nama')->join('mprofesi','sip.idprofesi','=','mprofesi.id')
            ->get(['idprofesi as id','mprofesi.nama']);
        $d['spesialisasi']=Profesi::where('isparent',1)->get();

        return view('laporan', ['d'=>$d]);
    }

    public function downloadLaporan(Request $request){

        // Data Nakes Teregistrasi/Tersertifikasi
        if($request->jenislaporan == 1){
            $data = Profesi::join('vw_agregatnakesbyprofesi', 'mprofesi.id', '=', 'vw_agregatnakesbyprofesi.idprofesi')->get();
            $data2 = STR::selectRaw('idprofesi, count(id) as totalaktif')
                ->where('isactive',1)->where('expiry','>',now())->groupBy('idprofesi')->get();
            
            return view('laporan.laporan1', ['data'=>$data, 'datastr'=>$data2]);
        }
        // Data Cetak Persetujuan Teknis
        elseif($request->jenislaporan == 2) {
            $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglawal)->format('Y-m-d');
            $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglakhir)->format('Y-m-d');

            $data = SIP::whereBetween('tglverif', [$periode['tglawal'], $periode['tglakhir']])->whereNotIn('idprofesi', [5,6,7])
                ->where('isactive',1)->orderBy('idprofesi')->with('pegawai:id,nik,nama,profesi')
                ->get(['id','idpegawai','nomor','nomorstr','expirystr','tglverif']);
                
            // Hapus row jika pegawai null
            for($i=0;$i<=count($data);$i++){
                if(!isset($data[$i]->pegawai)){
                    unset($data[$i]);
                }
            }

            return view('laporan.laporan2', ['data'=>$data, 'periode'=>$periode]);
        }
        // Data Tenaga Kesehatan di Fasyankes
        elseif($request->jenislaporan == 3){
            $faskes = Faskes::where('id', $request->idfaskes)->select('nama')->first();
            $query = 'SELECT A.id, A.idprofesi, A.idspesialisasi, A.nomor, A.expirystr, A.tglverif, B.id AS idpegawai, B.nama, B.tempatlahir, B.tanggallahir, B.spesialisasi, B.profesi AS namaprofesi
                FROM sip A
                JOIN mpegawai B ON A.idpegawai = B.id
                WHERE isactive = 1 AND A.idfaskes = '.$request->idfaskes.' AND A.idprofesi NOT IN (5,6,7) AND A.expirystr > "2019-12-31"
                ORDER BY A.idprofesi ASC, B.idspesialisasi ASC, B.nama ASC';
            $data = DB::select(DB::raw($query));
            
            return view('laporan.laporan3', ['data'=>$data, 'faskes'=>$faskes]);
        }
        // Data Nakes per Profesi
        elseif($request->jenislaporan == 4){
            $data = SIP::where('idprofesi', $request->idprofesi)
                ->where('isactive',1)->with('pegawai:id,nik,nama,tempatlahir,tanggallahir,alamatktp,alamat,profesi')
                ->orderBy('nomorregis')->get(['id','idpegawai','nomorregis','nomor','nomorstr','alamatfaskes','namafaskes','expirystr','tglverif']);

            // Hapus row jika pegawai null
            for($i=0;$i<=count($data);$i++){
                if(!isset($data[$i]->pegawai)){
                    unset($data[$i]);
                }
            }
            
            return view('laporan.laporan4', ['data'=>$data]);
        }
        // Data Nakes Praktik Mandiri
        elseif($request->jenislaporan == 5){
            $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglawal)->format('Y-m-d');
            $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglakhir)->format('Y-m-d');

            if($request->idprofesiman==0){
                $query = 'SELECT A.id, A.idprofesi, A.idspesialisasi, A.nomor, A.nomorstr, A.alamatfaskes, A.expirystr, A.tglverif, B.id AS idpegawai, B.nik, B.nama, B.tempatlahir, B.tanggallahir, B.alamatktp, B.alamat, B.spesialisasi, B.profesi AS namaprofesi, C.nama AS namapkm
                FROM sip A
                JOIN mpegawai B ON A.idpegawai = B.id
                LEFT JOIN mfaskes C ON A.idwilayahpkm = C.id
                WHERE isactive = 1 AND (A.tglverif BETWEEN \''.$periode['tglawal'].'\' AND \''.$periode['tglawal'].'\') AND A.namafaskes = "PRAKTIK MANDIRI" AND A.idprofesi NOT IN (5,6,7)
                ORDER BY A.idprofesi ASC, B.idspesialisasi ASC, B.nama ASC';
                $data['nakes'] = DB::select(DB::raw($query));
                $data['profesi'] = 'Semua Profesi';
            }else{
                $query = 'SELECT A.id, A.idprofesi, A.idspesialisasi, A.nomor, A.nomorstr, A.alamatfaskes, A.expirystr, A.tglverif, B.id AS idpegawai, B.nik, B.nama, B.tempatlahir, B.tanggallahir, B.alamatktp, B.alamat, B.spesialisasi, B.profesi AS namaprofesi, C.nama AS namapkm
                FROM sip A
                JOIN mpegawai B ON A.idpegawai = B.id
                LEFT JOIN mfaskes C ON A.idwilayahpkm = C.id
                WHERE isactive = 1 AND A.namafaskes = "PRAKTIK MANDIRI" AND A.idprofesi = '.$request->idprofesiman.' AND (A.tglverif BETWEEN \''.$periode['tglawal'].'\' AND \''.$periode['tglawal'].'\')
                ORDER BY A.idprofesi ASC, B.idspesialisasi ASC, B.nama ASC';
                $data['nakes'] = DB::select(DB::raw($query));
                $data['profesi'] = $data['nakes'][0]->namaprofesi;
            }
            // dd($request->all(), $data);
            return view('laporan.laporan5', ['data'=>$data]);
        }
        // Data Expiry Nakes 5 Tahunan
        elseif($request->jenislaporan == 6){
            $data = Profesi::join('vw_agregatnakesbyprofesi', 'mprofesi.id', '=', 'vw_agregatnakesbyprofesi.idprofesi')->orderBy('idprofesi')->get();
            $data2 = STR::selectRaw('idprofesi, year(expiry) as tahun, count(id) as totalaktif')
                ->where('isactive',1)->where('expiry','>',now())->groupBy('idprofesi','tahun')
                ->orderBy('idprofesi')->get();
            
            return view('laporan.laporan6', ['data'=>$data, 'datastr'=>$data2]);
        }
        // Data Nakes per Spesialisasi
        elseif($request->jenislaporan == 7){
            $data = STR::where('idprofesi', $request->idspesialisasi)->where('isactive',1)
                ->with('pegawai:id,nik,nama,tempatlahir,tanggallahir,alamatktp,alamat','spesialisasi:id,nama')
                ->orderBy('idspesialisasi')->get();
            $profesi = Profesi::findOrFail($request->idspesialisasi);
            return view('laporan.laporan7', ['data'=>$data, 'profesi'=>$profesi]);
        }
        // Laporan 9 Nakes
        elseif($request->jenislaporan == 8){
            $puskesmas = Faskes::where('idkategori', 1)->pluck('nama')->toArray();
            $profesi = [1,2,9,10,13,12,11,14,27];
            $data = SIP::selectRaw('idprofesi, namafaskes, count(id) as total')
                ->where('isactive',1)->whereIn('idprofesi', $profesi)->whereIn('namafaskes', $puskesmas)
                ->groupBy('idprofesi','namafaskes')->orderBy('namafaskes')->get();
            
            $pkm = '';
            $data2 = collect();
            $temp = collect();
            foreach($data as $unit){
                if($pkm == ''){
                    $pkm = $unit->namafaskes;
                    $temp->push($pkm);
                    $temp->put($unit->idprofesi, $unit->total);
                }elseif($pkm != $unit->namafaskes){
                    $data2->push($temp);
                    $temp = collect();
                    $pkm = $unit->namafaskes;
                    $temp->push($pkm);
                    $temp->put($unit->idprofesi, $unit->total);
                }else{
                    $temp->put($unit->idprofesi, $unit->total);
                }
            }
            $data2->push($temp);
            
            return view('laporan.laporan8', ['data'=>$data2]);
        }
        // Laporan Jumlah Nakes per Kategori Faskes
        elseif($request->jenislaporan == 9) {
            
            $data = SIP::leftJoin('mfaskes','mfaskes.id','sip.idfaskes')
                ->where('sip.isactive',1)->where('sip.expirystr','>', date('Y-m-d'))
                ->where('idkategori',9)->orWhere('idkategori','<',6)
                ->select('sip.idprofesi','mfaskes.idkategori',DB::raw('count(sip.id) as total'))
                ->groupBy('sip.idprofesi','mfaskes.idkategori')->orderBy('sip.idprofesi')->get();

            $datamandiri = SIP::where('saranapraktik','PRAKTIK MANDIRI')
                ->select('idprofesi',DB::raw('count(id) as total'))->groupBy('idprofesi')
                ->orderBy('idprofesi')->get();

            $rata = array();
            $i = 0;
            foreach($data as $key=>$unit){
                if($key == 0) $now = $unit->idprofesi;
                if($now != $unit->idprofesi){
                    $i = $unit->idkategori;
                    $now = $unit->idprofesi;
                    $rata[$now][0] = $unit['nama'];
                    $rata[$now][$i] = $unit->total;
                } else{
                    $i = $unit->idkategori;
                    $rata[$now][0] = $unit['nama'];
                    $rata[$now][$i] = $unit->total;
                }
            }

            foreach($datamandiri as $unit){
                $rata[$unit->idprofesi][8] = $unit->total;
            }

            $profesi = Profesi::get(['id','nama'])->toArray();
            
            return view('laporan.laporan9', ['data'=>$rata, 'profesi'=>$profesi]);
        }
        // Data Nakes Terverif per Periode
        elseif($request->jenislaporan == 10) {
            $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglawal)->format('Y-m-d');
            $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglakhir)->format('Y-m-d');

            $data = SIP::whereBetween('tglverif', [$periode['tglawal'], $periode['tglakhir']])->whereNotIn('idprofesi', [5,6,7])
                ->where('isactive',1)->with('profesirelation:id,nama')->orderBy('idprofesi')->groupBy('idprofesi')
                ->select('idprofesi',DB::raw('count(id) as total'))
                ->get();

            return view('laporan.laporan10', ['data'=>$data, 'periode'=>$periode]);
        }
        // Laporan Tambahan Nakes Periodik
        elseif($request->jenislaporan == 11) {
            $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglawal)->format('Y-m-d 00:00:01');
            $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglakhir)->format('Y-m-d 23:59:59');
            
            $data = Pegawai::whereBetween('doc', [$periode['tglawal'], $periode['tglakhir']])
                ->orderBy('profesi')->groupBy('profesi')
                ->select('profesi',DB::raw('count(id) as total'))
                ->get();

            return view('laporan.laporan11', ['data'=>$data, 'periode'=>$periode]);
        }
        // Laporan Tambahan Nakes Periodik
        elseif($request->jenislaporan == 12) {
            
            $data = SIP::whereNotNull('idwilayahpkm')->where('isactive',1)
                ->with('pegawai:id,nik,nama,profesi,alamat,alamatktp,tempatlahir,tanggallahir')
                ->leftJoin('mfaskes','sip.idwilayahpkm','mfaskes.id')
                ->leftJoin('mkec_kel','mfaskes.kelurahan','mkec_kel.nama_kel')
                ->orderBy('wilayah')->orderBy('nama_kec')
                ->orderBy('idwilayahpkm')->orderBy('idprofesi')
                ->get(['idpegawai','nomorstr','expirystr','nomor','alamatfaskes','tglverif','nama_kec','nama','wilayah']);
            
            return view('laporan.laporan12', ['data'=>$data]);
        }
        // Data Nakes MOU Limbah Medis dengan Pihak Ke-3
        elseif($request->jenislaporan == 13) {
            
            $data = SIP::whereNotNull('idptmou')->where('isactive',1)
                ->with('pegawai:id,nama,profesi','ptmou')
                ->orderBy('idprofesi')
                ->get(['idpegawai','expirystr','nomor','alamatfaskes','idptmou','nomormou','masamou']);
            
            return view('laporan.laporan13', ['data'=>$data]);
        }
        // Laporan PIH
        elseif($request->jenislaporan == 14) {
            $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglawal)->format('Y-m-d');
            $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->tglakhir)->format('Y-m-d');
            
            $dataSip = SIP::whereBetween('tglsurat', [$periode['tglawal'], $periode['tglakhir']])
                ->whereNotNull('tglverif')
                ->with('pegawai:id,nik,nama,profesi')
                ->orderBy('idprofesi')
                ->get(['idpegawai','nomor','tglsurat','tglverif'])->unique('nomor');

            $dataSurat = Surket::whereBetween('tglsurat', [$periode['tglawal'], $periode['tglakhir']])
                ->whereNotNull('tglverif')
                ->with('pegawai:id,nik,nama,profesi')
                ->get(['idpegawai','nosurat as nomor','tglsurat','tglverif']);
            
            foreach($dataSip as $unit){
                $unit->proses = $this->getWorkingDays($unit->tglverif,$unit->tglsurat);
            }
            foreach($dataSurat as $unit){
                $unit->proses = $this->getWorkingDays($unit->tglverif,$unit->tglsurat);
            }
            
            return view('laporan.laporan14', ['dataSip'=>$dataSip, 'dataSurat'=>$dataSurat, 'periode'=>$periode]);
        }
    }
    
    function getWorkingDays($startDate, $endDate){
        $begin = strtotime($startDate);
        $end   = strtotime($endDate);
        if ($begin > $end) {
            return "startdate is in the future!";
        } else {
            $no_days  = 0;
            $weekends = 0;
            while ($begin <= $end) {
                $no_days++; // no of days in the given interval
                $what_day = date("N", $begin);
                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                };
                $begin += 86400; // +1 day
            };
            $working_days = $no_days - $weekends;
    
            return $working_days-1;
        }
    }
}
