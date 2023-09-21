<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Barang;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use App\Member;
use App\Stok;
use App\Pengaturan;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    //index, create, store, show, edit, update and destroy
    public function index()
    {
        return view('transaksi.barang_keluar');
    }

    // PEMBELIAN
    public function pembelian()
    {
        $barang = Barang::get(['id', 'namabarang', 'kodebarang', 'harga_1', 'harga_3', 'harga_6']);

        return view('transaksi.pembelian', ['barang' => $barang]);
    }

    public function data()
    {
        // Lebih cepet pake raw() src: https://geekflare.com/laravel-optimization/
        // $data = Barang::raw('SELECT * FROM mbarang A JOIN mkategori B ON A.idkategori = B.id');
        $data = BarangKeluar::with('getMember:id,nama', 'getBarang:id,namabarang');
        $datatable = Datatables::of($data);
        $datatable->rawColumns(['action']);

        $datatable->addColumn('action', function ($t) {
            return
                '<span class="nav-item dropdown ">' .
                '<a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                '<i class="material-icons">more_vert</i>' .
                '</a>' .
                '<div class="dropdown-menu dropdown-menu-right" >' .
                '<a class="dropdown-item" href="#" onclick="view(this)" >Detail</a>' .
                '<a class="dropdown-item" href="' . route("cetak.struk", ["id" => $t->id]) .
                '" onclick="window.open(this.href, `_blank`, `width=,height=`); return false;">Cetak Struk</a>' .
                '<div class="dropdown-divider"></div>' .
                '<a class="dropdown-item" href="#" onclick="hapus(' . $t->id . ')">Hapus</a>' .
                '</div>' .
                '</span>';

        });

        return $datatable->make(true);
    }

    public function detail($id)
    {

        $data = BarangKeluarDetail::where('idtransaksi', $id)->with('getBarang:id,namabarang')->get();
        return $data;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $jumlah = 0;
            $nomorMax = BarangKeluar::whereNotNull('nomor')->where('tanggal', $request->tanggal)->orderBy('doc', 'desc')->first(['nomor']);
            // dd($request->all(), $nomorMax, \Carbon\Carbon::make($request->tanggal)->format('Ymd'));       
            if(isset($nomorMax)){
                $nomorMax = explode('-', $nomorMax->nomor);
                if (trim($nomorMax[0], 'BK') == \Carbon\Carbon::make($request->tanggal)->format('Ymd')) {
                    $max = base_convert($nomorMax[1], 10, 10);
                } else {
                    $max = 0;
                }
            } else {
                $max = 0;
            }

            $barang_keluar = new BarangKeluar($request->all());
            $barang_keluar->tanggal = \Carbon\Carbon::make($request->tanggal)->format('Y-m-d');
            $barang_keluar->nomor = 'BK' . \Carbon\Carbon::make($request->tanggal)->format('Ymd') . '-' . sprintf("%04d", $max + 1);
            $barang_keluar->jenis = 'Pembelian';
            $barang_keluar->save();

            foreach ($request->detail as $unit) {
                $harga = explode("||", $unit);
                $jumlah += $harga[3];
                $detail_barang = new BarangKeluarDetail([
                    'idtransaksi' => $barang_keluar->id,
                    'tanggal' => $barang_keluar->tanggal,
                    'nomor' => $barang_keluar->nomor,
                    'idmember' => $barang_keluar->idmember,
                    'idbarang' => $harga[0],
                    'qty' => $harga[1],
                    'h_sat' => $harga[2],
                    'jumlah' => $harga[3],
                ]);

                $stok = Stok::where('idbarang', $harga[0])->orderBy('doc')->get();
                // dd($stok, count($stok));
                $flag = 0;
                $sisaStok = count($stok);

                while ($harga[1] > 0 && isset($stok[$flag])) {
                    // Jika stok kembali tdk melebihi qtyin
                    if ($stok[$flag]->stok >= $harga[1]) {
                        $stok[$flag]->qtyout += $harga[1];
                        $stok[$flag]->stok -= $harga[1];
                        $harga[1] = 0;
                        $sisaStok = 0;
                    }
                    // Jika stok kembali melebihi qtyin dan sdh tdk ada stok lain
                    elseif ($sisaStok == 1 && $stok[$flag]->stok < $harga[1]) {
                        $stok[$flag]->qtyout += $harga[1];
                        $stok[$flag]->stok -= $harga[1];
                        $harga[1] = 0;

                    }
                    // Jika stok kembali melebihi qtyin
                    else {
                        $harga[1] -= $stok[$flag]->stok;
                        $stok[$flag]->qtyout += $stok[$flag]->stok;
                        $stok[$flag]->stok -= $stok[$flag]->stok;
                        $sisaStok--;
                    }

                    $stok[$flag]->save();
                    $flag++;

                }

                $detail_barang->save();
            }
            if (isset($request->idmember)) {
                $member = Member::findOrFail($request->idmember);
                $syarat = Pengaturan::where('key', 'min_belanja')->first();
                $hitung = $request->jumlah / $syarat->value;
                $member->poin += floor($hitung);
                $barang_keluar->poin = floor($hitung);
                $member->save();
            }

            $barang_keluar->jumlah = $jumlah;
            $barang_keluar->save();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }

        DB::commit();
        $this->flashSuccess('Transaksi Berhasil Ditambahkan');
        $barang = Barang::get(['id', 'namabarang', 'kodebarang', 'harga_1', 'harga_3', 'harga_6']);

        return view('transaksi.pembelian', ['barang' => $barang])->with('struk', $barang_keluar->id);
    }

    public function update(Request $request, $id)
    {
        try {
            $barang_masuk = BarangMasuk::findOrFail($id);
            $barang_masuk->fill($request->all());
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
            $barang_keluar = BarangKeluar::findOrFail($id);
            $detail = BarangKeluarDetail::where('idtransaksi', $barang_keluar->id)->get();

            foreach ($detail as $unit) {
                $stok = Stok::where('idbarang', $unit->idbarang)->orderBy('doc')->get();

                $flag = 0;
                while ($unit->qty > 0 && isset($stok[$flag])) {
                    // Jika stok kembali tdk melebihi qtyin
                    if ($stok[$flag]->qtyin >= $unit->qty + $stok[$flag]->stok) {
                        $stok[$flag]->qtyout -= $unit->qty;
                        $stok[$flag]->stok += $unit->qty;
                        $unit->qty = 0;

                    }
                    // Jika stok kembali melebihi qtyin
                    else {
                        $stokKembali = $stok[$flag]->qtyin - $stok[$flag]->stok;
                        $stok[$flag]->qtyout -= $stokKembali;
                        $stok[$flag]->stok += $stokKembali;
                        $unit->qty -= $stokKembali;

                    }

                    $stok[$flag]->save();
                    $flag++;

                }

                $unit->delete();
            }
            $barang_keluar->delete();

        } catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }

        DB::commit();
        $this->flashSuccess('Barang Keluar Berhasil Dihapus');
        return back();
    }

}