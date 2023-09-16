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
                '<a class="dropdown-item" href="#" onclick="view(this)" >Detail</a>' .
                '<a class="dropdown-item" href="" onclick="window.open(this.href, `_blank`, `width=,height=`); return false;">Cetak Struk</a>' .
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

    public function store(Request $request, $id)
    { 
        try {
            $retur = new Retur();
            $retur->fill($request->all());
            
            $list_hapus = explode('|', $request->list_hapus);
            foreach($list_hapus as $unit){
                if($unit!=''){
                    $detail = BarangMasukDetail::findOrFail($unit);
    
                    $stok = Stok::where('idbarang', $detail->idbarang)->where('idsupplier', $detail->idsupplier)->first();
                    $stok->qtyin -= $detail->qty;
                    $stok->stok -= $detail->qty;
                    $jumlah -= $detail->jumlah;

                    $detail->delete();
                    $stok->save();
                }
            }
            // dd($request->all(), $id, $list_hapus);

            if(isset($request->detail)){
                foreach ($request->detail as $unit) {
                    $harga = explode("||", $unit);
                    $jumlah += $harga[4];
                    $detail_barang = new BarangMasukDetail([
                        'idtransaksi' => $barang_masuk->id,
                        'tanggal' => $barang_masuk->tanggal,
                        'nomor' => $barang_masuk->nomor,
                        'idsupplier' => $barang_masuk->idsupplier,
                        'idbarang' => $harga[0],
                        'tglexp' => $harga[1]!="" ? $harga[1] : null,
                        'qty' => $harga[2],
                        'h_sat' => $harga[3],
                        'jumlah' => $harga[4],
                    ]);
    
                    $stok = Stok::where('idbarang', $harga[0])->where('idsupplier', $request->idsupplier)->first();
    
                    if (!$stok) {
                        $stok = new Stok([
                            'idbarang' => $harga[0],
                            'idsupplier' => $request->idsupplier,
                            'qtyin' => $harga[2],
                            'stok' => $harga[2],
                        ]);
                    } else {
                        $stok->qtyin += $harga[2];
                        $stok->stok += $harga[2];
                    }
                    // dd($detail_barang);
                    $stok->save();
                    $detail_barang->save();
                }
            }
            $barang_masuk->jumlah = $jumlah;
            $barang_masuk->save();
        } catch (Exception $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Barang Berhasil Diubah');
        return back();
    }
}
