<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retur;
use App\BarangMasuk;
use App\BarangMasukDetail;
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
                '<div class="dropdown-divider"></div>' .
                '<a class="dropdown-item" href="#" onclick="hapus(' . $t->id . ')">Hapus</a>' .
                '</div>' .
                '</span>';

        });

        return $datatable->make(true); 
    }

    public function detail($id){
        $data = BarangMasukDetail::where('idtransaksi', $id)->with('getBarang:id,namabarang')->get();
        return $data;
    }

    public function store(Request $request)
    { 
        try {
            $retur = new Retur();
            $barang_masuk = BarangMasuk::findOrFail($request->id_barangmasuk);

            $retur->fill($request->all());
            $retur->nomor = $barang_masuk->nomor.'-RE';
            
            // $list_hapus = explode('|', $request->list_hapus);
            // foreach($list_hapus as $unit){
            //     if($unit!=''){
            //         $detail = BarangMasukDetail::findOrFail($unit);
    
            //         $stok = Stok::where('idbarang', $detail->idbarang)->where('idsupplier', $detail->idsupplier)->first();
            //         $stok->qtyin -= $detail->qty;
            //         $stok->stok -= $detail->qty;
            //         $jumlah -= $detail->jumlah;

            //         $detail->delete();
            //         $stok->save();
            //     }
            // }
            // dd($request->all(), $id, $list_hapus);

            
            $barang_masuk->jumlah -= $request->jumlah;
            // dd($barang_masuk, $retur);
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
