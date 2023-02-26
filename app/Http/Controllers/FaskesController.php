<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Faskes;
use App\SIP;
use App\Kategori;
use App\KecamatanKelurahan;
use App\NIB;

class FaskesController extends Controller
{
    public function index(Request $request){
        $d['kategori'] = Kategori::all();
        $d['kelurahan'] = KecamatanKelurahan::get()->sortBy('nama_kel');
        
        return view('faskes', compact('d'));
    }

    public function indexMandiri(Request $request){
        return view('faskes');
    }

    public function data(){
        $data = Faskes::with('kategori');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function dataMandiri(){
        $data = SIP::where('saranapraktik', 'PRAKTIK MANDIRI')->where('isactive',1)->with('pegawai','puskesmas');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function show($id){
        $d['kategori'] = Kategori::all();
        $d['kelurahan'] = KecamatanKelurahan::all();

        $d['faskes'] = Faskes::where('id', $id)->with('kategori')->first();
        $d['nib'] = NIB::where('idfaskes',$id)->where('isactive',1)
            ->orderBy('tgl_terbit', 'DESC')->first();
        
        return view('bioFaskes', ['data'=> $d]);
    }

    public function rawHistorinib(Request $request){
        // dd($request->faskes);
        $idfaskes = $request->faskes;
        $nib = NIB::where('idfaskes', $idfaskes)->orderBy('id', 'desc')
            ->get(['idfaskes','nib','no_sertif','pemohon','since','expiry','tgl_terbit','isactive']);
        
        return view('raw.historinib', ['nib'=>$nib, 'idfaskes'=>$idfaskes]);
    }

    public function getpegawai($idfaskes){
        
        $datapegawai = SIP::where('idfaskes', $idfaskes)->where('isactive', 1)->select('nomor','tglverif','expirystr','idpegawai','sip.id','sip.idspesialisasi')
            ->whereNotIn('sip.idprofesi', [5,6,7])->with('pegawai:id,nama,tempatlahir,tanggallahir,profesi','spesialisasi:id,nama');
        // Untuk cek data pegawai kosong
        // for($i=0;$i<=count($datapegawai);$i++){
        //     if(!isset($datapegawai[$i]->pegawai)) dd($datapegawai[$i]);
        // }
        $datatable = Datatables::of($datapegawai);
        $datatable->addColumn('action', function ($t) { 
            return '<a href="'.route('bio').'?nakes='.$t->idpegawai.'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>&nbsp';
        });
        return $datatable->addIndexColumn()->make(true);
    }

    public function store(Request $request){
        try{
            $faskes_baru = new Faskes($request->all());
            $kelurahan = explode(",", $faskes_baru->kelurahan);
            $faskes_baru->kelurahan = $kelurahan[0];
            $faskes_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Faskes Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $faskes = Faskes::findOrFail($id);
            $faskes->fill($request->all());
            $kelurahan = explode(",", $faskes->kelurahan);
            $faskes->kelurahan = $kelurahan[0];
            $faskes->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Faskes Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $faskes = Faskes::findOrFail($id);
            $faskes->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Faskes Berhasil Dihapus');
        return back();
    }

    public function map(){
        $faskes = Faskes::whereNotNull('coord_x')->whereNotNull('coord_y')->get(['id','nama','idkategori','coord_x','coord_y']);
        
        return view('map_faskes', ['faskes'=>$faskes]);
    }
}
