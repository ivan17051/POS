<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Barang;
use App\BarangMasuk;
use App\BarangMasukDetail;
use App\Supplier;
use App\Stok;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    //index, create, store, show, edit, update and destroy
    public function index()
    {
        $d['barang'] = Barang::get(['id', 'namabarang', 'kodebarang']);
        $d['supplier'] = Supplier::get(['id', 'nama']);
        return view('transaksi.barang_masuk', $d);
    }

    public function data()
    {
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = BarangMasuk::with('getSupplier');
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);

        $datatable->addColumn('action', function ($t) {
            if ($t->metode == 'kredit') {
                return
                    '<span class="nav-item dropdown ">' .
                    '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                    '<i class="material-icons">more_vert</i>' .
                    '</a>' .
                    '<div class="dropdown-menu dropdown-menu-right" >' .
                    '<a class="dropdown-item" href="#" onclick="view(this)" >Detail</a>' .
                    '<a class="dropdown-item" href="'. route('barang_masuk.edit', ['id'=>$t->id]) .'">Edit</a>' .
                    '<a class="dropdown-item" href="#" onclick="cetak(' . $t->id . ')" >Cetak</a>' .
                    '<a class="dropdown-item" href="#" onclick="pembayaran(this)" >Pembayaran</a>' .
                    '<a class="dropdown-item" href="#" onclick="retur(' . $t->id . ')" >Retur</a>' .
                    '<div class="dropdown-divider"></div>' .
                    '<a class="dropdown-item" href="#" onclick="hapus(' . $t->id . ')">Hapus</a>' .
                    '</div>' .
                    '</span>';
            } else {
                return
                    '<span class="nav-item dropdown ">' .
                    '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                    '<i class="material-icons">more_vert</i>' .
                    '</a>' .
                    '<div class="dropdown-menu dropdown-menu-right" >' .
                    '<a class="dropdown-item" href="#" onclick="view(this)" >Detail</a>' .
                    '<a class="dropdown-item" href="'. route('barang_masuk.edit', ['id'=>$t->id]) .'">Edit</a>' .
                    '<a class="dropdown-item" href="#" onclick="cetak(' . $t->id . ')" >Cetak</a>' .
                    '<a class="dropdown-item" href="#" onclick="retur(' . $t->id . ')" >Retur</a>' .
                    '<div class="dropdown-divider"></div>' .
                    '<a class="dropdown-item" href="#" onclick="hapus(' . $t->id . ')">Hapus</a>' .
                    '</div>' .
                    '</span>';
            }

            // '<a href="" class="btn btn-info btn-link" style="padding:5px;" target="_blank" rel="noreferrer noopener"><i class="material-icons">launch</i></a>&nbsp'.
            // '<button type="button" class="btn btn-sm btn-info btn-link" style="padding:5px;" onclick="view(this)"><i class="material-icons">visibility</i></button>&nbsp'.
            // '<button type="button" class="btn btn-sm btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
            // '<button type="button" class="btn btn-sm btn-danger btn-link" style="padding:5px;" onclick="hapus('.$t->id.')"><i class="material-icons">delete</i></button>';
        });

        return $datatable->make(true);
    }

    public function detail($id)
    {

        $data = BarangMasukDetail::where('idtransaksi', $id)->with('getSupplier:id,nama', 'getBarang:id,namabarang')->get();
        return $data;
    }

    public function cetak($id)
    {

        $d['main'] = BarangMasuk::where('id', $id)->with('getSupplier:id,nama,alamat')->first();
        $d['detail'] = BarangMasukDetail::where('idtransaksi', $id)->with('getBarang:id,namabarang')->get();

        return view('report.bukti_bm', $d);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $jumlah = 0;
            $nomorMax = BarangMasuk::whereNotNull('nomor')->orderBy('doc', 'desc')->first(['nomor']);
            if(isset($nomorMax)){
                $nomorMax = explode('-', $nomorMax->nomor);
                
                if (trim($nomorMax[0], 'BM') == date('Ymd')) {
                    $max = base_convert($nomorMax[1], 10, 10);
                } else {
                    $max = 0;
                }
            } else {
                $max = 0;
            }

            $barang_masuk = new BarangMasuk($request->all());
            $barang_masuk->nomor = 'BM' . date('Ymd') . '-' . sprintf("%04d", $max + 1);
            if ($request->metode == 'cash')
                $barang_masuk->islunas = 1;
            // dd($barang_masuk, $request->all());
            $barang_masuk->save();

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

            $barang_masuk->jumlah = $jumlah;
            $barang_masuk->save();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }

        DB::commit();
        $this->flashSuccess('Barang Masuk Berhasil Ditambahkan');
        return back();
    }

    public function edit($id){
        
        $d['barang_masuk'] = BarangMasuk::findOrFail($id);
        $d['detail'] = BarangMasukDetail::where('idtransaksi', $id)->with('getBarang:id,namabarang')->get();
        $d['barang'] = Barang::get(['id', 'namabarang', 'kodebarang']);
        $d['supplier'] = Supplier::get(['id', 'nama']);
        
        return view('transaksi.barang_masuk_edit', $d);
    }

    public function update(Request $request, $id)
    {
        
        try {
            $barang_masuk = BarangMasuk::findOrFail($id);
            $jumlah = $barang_masuk->jumlah;
            // dd($barang_masuk);
            $barang_masuk->fill($request->all());
            
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

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $barang_masuk = BarangMasuk::findOrFail($id);
            $detail = BarangMasukDetail::where('nomor', $barang_masuk->nomor)->get();

            foreach ($detail as $unit) {
                $stok = Stok::where('idsupplier', $unit->idsupplier)->where('idbarang', $unit->idbarang)->first();
                $stok->qtyin -= $unit->qty;
                $stok->stok -= $unit->qty;
                $stok->save();

                $unit->delete();
            }

            $barang_masuk->delete();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }

        DB::commit();
        $this->flashSuccess('Barang Masuk Berhasil Dihapus');
        return back();
    }
}