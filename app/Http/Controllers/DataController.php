<?php

namespace App\Http\Controllers;

use App\BarangMasukDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Stok;
use App\Barang;
use App\Member;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use DB;
use Validator;

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

        return view('laporan');
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
                $data = BarangKeluarDetail::with('getBarang:id,kodebarang,namabarang')->get(['id', 'idbarang', 'qty']);
            }

            return view('laporan.laporan3', ['data' => $data, 'periode' => $periode]);
        }

        // Laporan Stok
        elseif ($request->jenislaporan == 4) {

            $data = Stok::with('getBarang:id,namabarang', 'getSupplier:id,nama')->get(['id', 'idbarang', 'idsupplier', 'qtyin', 'qtyout', 'penyesuaian', 'stok']);

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