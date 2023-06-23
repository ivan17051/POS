<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Barang;
use App\Member;
use DB;
use Datatables;
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

        // Data Nakes Teregistrasi/Tersertifikasi
        if ($request->jenislaporan == 1) {
            $data = Profesi::join('vw_agregatnakesbyprofesi', 'mprofesi.id', '=', 'vw_agregatnakesbyprofesi.idprofesi')->get();
            $data2 = STR::selectRaw('idprofesi, count(id) as totalaktif')
                ->where('isactive', 1)->where('expiry', '>', now())->groupBy('idprofesi')->get();

            return view('laporan.laporan1', ['data' => $data, 'datastr' => $data2]);
        }
        // Data Cetak Persetujuan Teknis
        elseif ($request->jenislaporan == 2) {
            $periode['tglawal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglawal)->format('Y-m-d');
            $periode['tglakhir'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tglakhir)->format('Y-m-d');

            $data = SIP::whereBetween('tglverif', [$periode['tglawal'], $periode['tglakhir']])->whereNotIn('idprofesi', [5, 6, 7])
                ->where('isactive', 1)->orderBy('idprofesi')->with('pegawai:id,nik,nama,profesi')
                ->get(['id', 'idpegawai', 'nomor', 'nomorstr', 'expirystr', 'tglverif']);

            // Hapus row jika pegawai null
            for ($i = 0; $i <= count($data); $i++) {
                if (!isset($data[$i]->pegawai)) {
                    unset($data[$i]);
                }
            }

            return view('laporan.laporan2', ['data' => $data, 'periode' => $periode]);
        }
        // Data Tenaga Kesehatan di Fasyankes
        elseif ($request->jenislaporan == 3) {
            $faskes = Faskes::where('id', $request->idfaskes)->select('nama')->first();
            $query = 'SELECT A.id, A.idprofesi, A.idspesialisasi, A.nomor, A.expirystr, A.tglverif, B.id AS idpegawai, B.nama, B.tempatlahir, B.tanggallahir, B.spesialisasi, B.profesi AS namaprofesi
                FROM sip A
                JOIN mpegawai B ON A.idpegawai = B.id
                WHERE isactive = 1 AND A.idfaskes = ' . $request->idfaskes . ' AND A.idprofesi NOT IN (5,6,7) AND A.expirystr > "2019-12-31"
                ORDER BY A.idprofesi ASC, B.idspesialisasi ASC, B.nama ASC';
            $data = DB::select(DB::raw($query));

            return view('laporan.laporan3', ['data' => $data, 'faskes' => $faskes]);
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