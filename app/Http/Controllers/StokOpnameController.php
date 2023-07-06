<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stok;
use App\StokOpname;
use App\StokOpnameDetail;
use App\Barang;
use Datatables;
use DB;

class StokOpnameController extends Controller
{
    public function index(){
        $barang = Barang::leftJoin('stok','mbarang.id','stok.idbarang')
            ->groupBy('idbarang','namabarang','kodebarang')->selectRaw('idbarang, namabarang, kodebarang, sum(stok) as stok')->get();
        
        return view('stokopname.stokopname',['barang'=>$barang]);
    }

    public function data(){
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = StokOpname::all();
        $datatable = Datatables::of($data);
        
        return $datatable->make(true); 
    }

    public function detail($id){
        $data = StokOpnameDetail::where('idstokopname', $id)->with('getBarang:id,namabarang')->get();
        return $data; 
    }

    public function store(Request $request){
        DB::beginTransaction();
        try{
            $jumlah = 0;
            // STOKOPN/MEI/23/001
            $nomorMax = StokOpname::whereNotNull('nostokopname')->orderBy('doc','desc')->first(['nostokopname']);
            if(isset($nomorMax)){
                $nomorMax = explode('/',$nomorMax->nostokopname);
            
                if($nomorMax[1] == strtoupper(date('M')) && $nomorMax[2] == date('y')) {
                    $max = base_convert($nomorMax[3],10,10);
                } else {
                    $max = 0;
                }
            } else {
                $max = 0;
            }
            
            $stokopname = new StokOpname($request->all());
            $stokopname->nostokopname = 'STOKOPN/'.strtoupper(date('M')).'/'.date('y').'/'.sprintf("%03d", $max+1);
            $stokopname->status='draft';
            $stokopname->save();
            
            foreach($request->detail as $unit){
                $harga = explode("||",$unit);
                $detail_barang = new StokOpnameDetail([
                    'idstokopname'  => $stokopname->id,
                    'tanggal'       => $stokopname->tglstokponame,
                    'nomor'         => $stokopname->nostokopname,
                    'idbarang'      => $harga[0],
                    'stok'          => $harga[1],
                    'stokreal'      => $harga[2],
                    'selisih'       => $harga[3],
                    'status'        => 'draft',
                ]);
                
                $detail_barang->save();
            }
            
        }catch(Exception $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }

        DB::commit();
        $this->flashSuccess('Stok Opname Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $supplier = Supplier::findOrFail($id);
            $supplier->fill($request->all());
            $supplier->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Supplier Berhasil Diubah');
        return back();
    }

    public function sesuaikan($id){
        $data['stok'] = StokOpname::where('id', $id)->first();
        $data['detail'] = StokOpnameDetail::where('idstokopname', $id)->with('getBarang:id,namabarang')->get();
        
        return view('stokopname.sesuaikan',$data);
    }

    public function sesuaikanStore(Request $request){
        DB::beginTransaction();
        try{
            // PENSTOK/MEI/23/001
            $nomorMax = StokOpname::whereNotNull('nopenyesuaian')->orderBy('doc','desc')->first(['nopenyesuaian']);
            if(isset($nomorMax)){
                $nomorMax = explode('/',$nomorMax->nopenyesuaian);

                if($nomorMax[1] == strtoupper(date('M')) && $nomorMax[2] == date('y')) {
                    $max = base_convert($nomorMax[3],10,10);
                } else {
                    $max = 0;
                }
            } else {
                $max = 0;
            }

            $stokopname = StokOpname::where('id',$request->id)->first();
            $stokopname->fill($request->all());
            
            $stokopname->nopenyesuaian = 'PENSTOK/'.strtoupper(date('M')).'/'.date('y').'/'.sprintf("%03d", $max+1);
            $stokopname->status='final';
            $stokopname->save();

            $detail = StokOpnameDetail::where('idstokopname', $request->id)->get();
            
            foreach($detail as $unit){
                $unit->status = 'final';
                $stok = Stok::where('idbarang',$unit->idbarang)->orderBy('doc','desc')->get();
                if(count($stok)>0 && ){

                }
                $stok->penyesuaian = $unit->selisih;
                $stok->stok = $stok->stok + $unit->selisih;

                $stok->save();
                $unit->save();
            }

            // dd($request->all(), $stokopname, $detail);
        }catch(Exception $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }

        DB::commit();
        $this->flashSuccess('Penyesuaian Berhasil');
        return back();
    }
}
