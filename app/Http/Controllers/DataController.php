<?php

namespace App\Http\Controllers;

use App\BarangMasukDetail;
use App\Exports\ExportLaporanStok;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Stok;
use App\Barang;
use App\Member;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use DB;
use Excel;

class DataController extends Controller
{

    public function getBarang(Request $request)
    {
        $data = $request->input('query');
        $data = Barang::where('namabarang', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('kodebarang', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(10)
            ->get();
        return response()->json($data);
    }

    public function getMember(Request $request)
    {
        $data = $request->input('query');
        $data = Member::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('alamat', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('notelp', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(5)
            ->get();
        return response()->json($data);
    }

    public function laporan()
    {
        $lokasi = Barang::whereNotNull('lokasi')->groupBy('lokasi')->get(['lokasi']);
        
        return view('laporan', ['lokasi'=>$lokasi]);
    }

    public function downloadLaporan(Request $request)
    {

        // Laporan Penualan Barang
        if ($request->jenislaporan == 1) {
            if (isset($request->tglawal))
                $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglawal)->format('Y-m-d');
            if (isset($request->tglakhir))
                $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglakhir)->format('Y-m-d');

            if (isset($periode['tglawal']) && isset($periode['tglakhir']))
                $data = BarangKeluarDetail::whereBetween('tanggal', [$periode['tglawal'], $periode['tglakhir']])->with('getBarang:id,kodebarang,namabarang')->get(['id', 'idbarang', 'qty', 'tanggal']);
            elseif (isset($periode['tglawal'])) {
                $periode['tglakhir'] = date('Y-m-d');
                $data = BarangKeluarDetail::where('tanggal', '>=', $periode['tglawal'])->with('getBarang:id,kodebarang,namabarang')->get(['id', 'idbarang', 'qty', 'tanggal']);
            } elseif (isset($periode['tglakhir'])) {
                $data = BarangKeluarDetail::with('getBarang:id,kodebarang,namabarang')->where('tanggal', '<=', $periode['tglakhir'])->oldest('tanggal')->get(['id', 'idbarang', 'qty', 'tanggal']);
                $periode['tglawal'] = $data[0]->tanggal;
            } else {
                $periode = null;
                $data = BarangKeluarDetail::with('getBarang:id,kodebarang,namabarang')->get(['id', 'idbarang', 'qty']);
            }

            return view('laporan.laporan1', ['data' => $data, 'periode' => $periode]);
        }
        // Laporan Pendapatan / Pemasukan
        elseif ($request->jenislaporan == 2) {
            if (isset($request->tglawal))
                $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglawal)->format('Y-m-d');
            if (isset($request->tglakhir))
                $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglakhir)->format('Y-m-d');

            if (isset($periode['tglawal']) && isset($periode['tglakhir']))
                $data = BarangKeluar::where('jenis', 'Pembelian')->whereBetween('tanggal', [$periode['tglawal'], $periode['tglakhir']])->with('getMember:id,nama')->get();
            elseif (isset($periode['tglawal'])) {
                $periode['tglakhir'] = date('Y-m-d');
                $data = BarangKeluar::where('jenis', 'Pembelian')->where('tanggal', '>=', $periode['tglawal'])->with('getMember:id,nama')->get();
            } elseif (isset($periode['tglakhir'])) {
                $data = BarangKeluar::where('jenis', 'Pembelian')->where('tanggal', '<=', $periode['tglakhir'])->with('getMember:id,nama')->oldest('tanggal')->get();
                $periode['tglawal'] = $data[0]->tanggal;
            } else {
                $periode = null;
                $data = BarangKeluar::where('jenis', 'Pembelian')->with('getMember:id,nama')->get(['id', 'idmember', 'nomor', 'tanggal', 'jumlah']);
            }

            return view('laporan.laporan2', ['data' => $data, 'periode' => $periode]);
        }
        // Laporan Laba / Rugi
        elseif ($request->jenislaporan == 3) {
            if (isset($request->tglawal))
                $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglawal)->format('Y-m-d');
            if (isset($request->tglakhir))
                $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglakhir)->format('Y-m-d');

            if (isset($periode['tglawal']) && isset($periode['tglakhir'])){
                $query = 'SELECT A.idbarang, A.idsupplier, B.namabarang, Ca.h_sat AS hargabeli, Cb.h_sat AS hargajual, Cb.qty AS qtyjual, Cb.nomor AS nomortransaksi
                FROM stok A
                LEFT JOIN barang_masuk_detail Ca ON A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier
                LEFT JOIN barang_keluar_detail Cb ON Cb.idbarang = A.idbarang
                LEFT JOIN mbarang B ON A.idbarang = B.id
                WHERE Cb.tanggal BETWEEN \''.$periode['tglawal'].'\' AND \''.$periode['tglakhir'].'\' AND A.qtyout > 0 AND A.stok > 0';
                
                $data = DB::select(DB::raw($query));

            } elseif (isset($periode['tglawal'])) {
                $periode['tglakhir'] = date('Y-m-d');
                
                $query = 'SELECT A.idbarang, A.idsupplier, B.namabarang, Ca.h_sat AS hargabeli, Cb.h_sat AS hargajual, Cb.qty AS qtyjual, Cb.nomor AS nomortransaksi
                FROM stok A
                LEFT JOIN barang_masuk_detail Ca ON A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier
                LEFT JOIN barang_keluar_detail Cb ON Cb.idbarang = A.idbarang
                LEFT JOIN mbarang B ON A.idbarang = B.id
                WHERE Cb.tanggal BETWEEN \''.$periode['tglawal'].'\' AND \''.$periode['tglakhir'].'\' AND A.qtyout > 0 AND A.stok > 0';
                
                $data = DB::select(DB::raw($query));
            } elseif (isset($periode['tglakhir'])) {
                $tglawal = BarangKeluarDetail::oldest('tanggal')->first(['tanggal']);
                $periode['tglawal'] = $tglawal->tanggal;

                $query = 'SELECT A.idbarang, A.idsupplier, B.namabarang, Ca.h_sat AS hargabeli, Cb.h_sat AS hargajual, Cb.qty AS qtyjual, Cb.nomor AS nomortransaksi
                FROM stok A
                LEFT JOIN barang_masuk_detail Ca ON A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier
                LEFT JOIN barang_keluar_detail Cb ON Cb.idbarang = A.idbarang
                LEFT JOIN mbarang B ON A.idbarang = B.id
                WHERE Cb.tanggal BETWEEN \''.$periode['tglawal'].'\' AND \''.$periode['tglakhir'].'\' AND A.qtyout > 0 AND A.stok > 0';
                
                $data = DB::select(DB::raw($query));
            } else {
                $periode = null;
                $query = 'SELECT A.idbarang, A.idsupplier, B.namabarang, Ca.h_sat AS hargabeli, Cb.h_sat AS hargajual, Cb.qty AS qtyjual, Cb.nomor AS nomortransaksi
                FROM stok A
                LEFT JOIN barang_masuk_detail Ca ON A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier
                LEFT JOIN barang_keluar_detail Cb ON Cb.idbarang = A.idbarang
                LEFT JOIN mbarang B ON A.idbarang = B.id
                WHERE A.qtyout > 0 AND A.stok > 0';

                $data = DB::select(DB::raw($query));
                
            }

            return view('laporan.laporan3', ['data' => $data, 'periode' => $periode]);
        }

        // Laporan Stok
        elseif ($request->jenislaporan == 4) {
            // dd($request->all());
            if($request->lokasi == 'semua'){
                // $data = Stok::with('getBarang:id,namabarang,kodebarang')->get(['id', 'idbarang', 'stok']);
                $query = 'SELECT A.idbarang, A.idsupplier, A.stok, B.lokasi, B.namabarang, B.kodebarang, max(Ca.h_sat) AS hargabeli
                FROM stok A
                JOIN barang_masuk_detail Ca ON (A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier)
                JOIN mbarang B ON A.idbarang = B.id
                WHERE A.stok > 0
                GROUP BY A.id, A.idbarang, A.idsupplier, A.stok, B.lokasi, B.namabarang, B.kodebarang
                ORDER BY A.idbarang';
            } else {
                $query = 'SELECT A.idbarang, A.idsupplier, A.stok, B.lokasi, B.namabarang, B.kodebarang, max(Ca.h_sat) AS hargabeli
                FROM stok A
                JOIN barang_masuk_detail Ca ON (A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier)
                JOIN mbarang B ON A.idbarang = B.id
                WHERE A.stok > 0 AND B.lokasi =\''.$request->lokasi.'\'
                GROUP BY A.id, A.idbarang, A.idsupplier, A.stok, B.lokasi, B.namabarang, B.kodebarang
                ORDER BY A.idbarang';
            }

            $data = DB::select(DB::raw($query));
            // dd($data);
            return view('laporan.laporan4', ['data' => $data]);
        }

        // Laporan Barang Mendekati / Sudah Expired
        elseif ($request->jenislaporan == 5) {

            $data = BarangMasukDetail::whereNotNull('tglexp')->with('getBarang:id,namabarang', 'getSupplier:id,nama')->orderBy('tglexp', 'desc')->get(['id', 'idbarang', 'idsupplier', 'nomor', 'tglexp', 'qty']);

            return view('laporan.laporan5', ['data' => $data]);
        }

        // Laporan Barang Paling Laku & Tidak Laku
        elseif ($request->jenislaporan == 6) {

            if (isset($request->tglawal))
                $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglawal)->format('Y-m-d');
            if (isset($request->tglakhir))
                $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglakhir)->format('Y-m-d');

            if (isset($periode['tglawal']) && isset($periode['tglakhir']))
                $data = BarangKeluarDetail::whereBetween('tanggal', [$periode['tglawal'], $periode['tglakhir']])->with('getBarang:id,kodebarang,namabarang')->groupBy('idbarang')
                    ->select('idbarang', DB::raw('sum(qty) as jumlah'))->orderBy('jumlah', 'desc')->get();
            elseif (isset($periode['tglawal'])) {
                $periode['tglakhir'] = date('Y-m-d');
                $data = BarangKeluarDetail::where('tanggal', '>=', $periode['tglawal'])->with('getBarang:id,kodebarang,namabarang')->groupBy('idbarang')
                    ->select('idbarang', DB::raw('sum(qty) as jumlah'))->orderBy('jumlah', 'desc')->get();
            } elseif (isset($periode['tglakhir'])) {
                $data = BarangKeluarDetail::where('tanggal', '<=', $periode['tglakhir'])->with('getBarang:id,kodebarang,namabarang')->groupBy('idbarang')
                    ->select('idbarang', DB::raw('sum(qty) as jumlah'))->orderBy('jumlah', 'desc')->get();
                $periode['tglawal'] = '2020-10-10';
            } else {
                $periode = null;
                $data = BarangKeluarDetail::with('getBarang:id,kodebarang,namabarang')->groupBy('idbarang')->select('idbarang', DB::raw('sum(qty) as jumlah'))->orderBy('jumlah', 'desc')->get();
            }

            return view('laporan.laporan6', ['data' => $data, 'periode' => $periode]);
        }
        // Laporan Pendapatan / Pemasukan Per Jenis Pembayaran
        elseif ($request->jenislaporan == 7) {
            if (isset($request->tglawal))
                $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglawal)->format('Y-m-d');
            if (isset($request->tglakhir))
                $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglakhir)->format('Y-m-d');

            if (isset($periode['tglawal']) && isset($periode['tglakhir'])){
                $query = 'SELECT A.tanggal, A.metode, SUM(A.jumlah) AS total, COUNT(A.id) AS jumTransaksi
                FROM barang_keluar A
                WHERE A.jenis = "Pembelian" AND A.tanggal BETWEEN \''. $periode['tglawal'].'\' AND \''. $periode['tglakhir'].'\'
                GROUP BY tanggal, metode';
                $data = DB::select(DB::raw($query));
                // $data = BarangKeluar::where('jenis', 'Pembelian')->whereBetween('tanggal', [$periode['tglawal'], $periode['tglakhir']])->get();
                
            } elseif (isset($periode['tglawal'])) {
                $query = 'SELECT A.tanggal, A.metode, SUM(A.jumlah) AS total, COUNT(A.id) AS jumTransaksi
                FROM barang_keluar A
                WHERE A.jenis = "Pembelian" AND A.tanggal >= \''. $periode['tglawal'].'\'
                GROUP BY tanggal, metode';
                $data = DB::select(DB::raw($query));
                $periode['tglakhir'] = date('Y-m-d');

            } elseif (isset($periode['tglakhir'])) {
                $query = 'SELECT A.tanggal, A.metode, SUM(A.jumlah) AS total, COUNT(A.id) AS jumTransaksi
                FROM barang_keluar A
                WHERE A.jenis = "Pembelian" AND A.tanggal <= \''. $periode['tglakhir'].'\'
                GROUP BY tanggal, metode';
                $data = DB::select(DB::raw($query));
                // $data = BarangKeluar::where('jenis', 'Pembelian')->where('tanggal', '<=', $periode['tglakhir'])->oldest('tanggal')->get();
                // $periode['tglawal'] = $data[0]->tanggal;

            } else {
                $periode = null;
                $query = 'SELECT A.tanggal, A.metode, SUM(A.jumlah) AS total, COUNT(A.id) AS jumTransaksi
                FROM barang_keluar A
                WHERE A.jenis = "Pembelian"
                GROUP BY tanggal, metode';

                $data = DB::select(DB::raw($query));
                // $data = BarangKeluar::where('jenis', 'Pembelian')->orderBy('')->get(['id', 'idmember', 'nomor', 'tanggal', 'jumlah']);
            }
            // dd($data, $periode);
            return view('laporan.laporan7', ['data' => $data, 'periode' => $periode]);
        }
        // Laporan Harga Jual Barang
        elseif ($request->jenislaporan == 8) {

            $query = 'SELECT A.kodebarang, A.namabarang, B.stok AS qty, A.harga_1, A.harga_3, A.harga_6
            FROM mbarang A
            LEFT JOIN (SELECT Ba.idbarang AS idbarang, SUM(Ba.stok) AS stok FROM stok Ba GROUP BY Ba.idbarang) B ON A.id = B.idbarang';
            
            $data = DB::select(DB::raw($query));
            // dd($data);
            return view('laporan.laporan8', ['data' => $data]);
        }

    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new ExportLaporanStok('ATK1'), 'MttRegistrations.xlsx');
    }

    function getWorkingDays($startDate, $endDate)
    {
        $begin = strtotime($startDate);
        $end = strtotime($endDate);
        if ($begin > $end) {
            return "startdate is in the future!";
        } else {
            $no_days = 0;
            $weekends = 0;
            while ($begin <= $end) {
                $no_days++; // no of days in the given interval
                $what_day = date("N", $begin);
                if ($what_day > 5) { // 6 and 7 are weekend days
                    $weekends++;
                }
                ;
                $begin += 86400; // +1 day
            }
            ;
            $working_days = $no_days - $weekends;

            return $working_days - 1;
        }
    }
}