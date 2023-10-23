<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retur;
use App\BarangMasuk;
use App\BarangMasukDetail;
use App\Stok;
use Datatables;

class ReturController extends Controller
{
    public function index(){
        $model = BarangMasuk::get(['id','nomor','jumlah']);
        return view('transaksi.retur', ['barang_masuk'=>$model]);
    }

    public function data(){
        $data = Retur::with('getNomor:id,nomor');
        $datatable = Datatables::of($data);
        $datatable->addColumn('action', function ($t) {
            return
                '<span class="nav-item dropdown ">' .
                '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                '<i class="material-icons">more_vert</i>' .
                '</a>' .
                '<div class="dropdown-menu dropdown-menu-right" >' .
                '<a class="dropdown-item" href="'.route('cetak.retur',['id'=>$t->id]).'">Cetak</a>' .
                '</div>' .
                '</span>';

        });

        return $datatable->make(true); 
    }

    public function detail($id){
        $data = BarangMasukDetail::where('idtransaksi', $id)->with('getBarang:id,namabarang')->get();
        return $data;
    }

    public function create($id){
        $data = BarangMasukDetail::where('idtransaksi', $id)->with('getBarang:id,namabarang')->get();
        return view('transaksi.retur_add', ['barang'=>$data]);
    }

    public function store(Request $request)
    { 
        try {
            // dd($request->all());
            $retur = new Retur();
            $barang_masuk = BarangMasuk::findOrFail($request->id_barangmasuk);
            $total = 0;
            $idbarang = '';

            $retur->fill([
                'id_barangmasuk'    => $request->id_barangmasuk,
                'tanggal'           => $request->tanggal,
            ]);
            $detail = BarangMasukDetail::where('idtransaksi',$request->id_barangmasuk)->get();
            dd($detail, $request->all());
            for($x=0;$x<count($detail);$x++){
                $detail[$x]->qty -= $request->stok[$x];

                if($request->stok[$x]>0) $idbarang = $idbarang.'|'.$detail[$x]->idbarang.','.$request->stok[$x];
                $detail[$x]->jumlah = $detail[$x]->qty * $detail[$x]->h_sat;
                $total += $request->stok[$x] * $detail[$x]->h_sat;

                $stok = Stok::where('idbarang', $detail[$x]->idbarang)->where('idsupplier', $detail[$x]->idsupplier)->first();
                $stok->qtyin -= $request->stok[$x];
                $stok->stok -= $request->stok[$x];
                
                $stok->save();
                $detail[$x]->save();
            }
            // dd($detail, $request->all(), $stok);
            $retur->nomor = $barang_masuk->nomor.'_RE';
            $retur->id_detailbarangmasuk = $idbarang;
            $retur->jumretur = $total;

            $barang_masuk->jumlah -= $total;
            
            $barang_masuk->save();
            $retur->save();
        } catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Retur Berhasil Ditambahkan');
        return back();
    }
}
