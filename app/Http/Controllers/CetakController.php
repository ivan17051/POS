<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\BarangKeluar;
use App\BarangKeluarDetail;
use App\Pejabat;
use App\Pegawai;
use App\JenisPermohonan;
use App\Surket;

class CetakController extends Controller
{
    public function barcode($id)
    {
        $barang = Barang::findOrFail($id);
        return view('report.barcode', ['barang' => $barang]);
    }

    public function struk($id)
    {
        $d['barang_keluar'] = BarangKeluar::where('id', $id)->with('getMember:id,nama,notelp,poin')->first();
        $d['detail'] = BarangKeluarDetail::where('idtransaksi', $id)
            ->with('getBarang:id,kodebarang,namabarang')->get(['idbarang', 'qty', 'h_sat', 'jumlah']);
        // dd($d);
        return view('report.struk', $d);
    }

    public function kitir(Request $request, $idsip)
    {
        if ($request->jenis == 'surket') {
            $d['sip'] = Surket::where('id', $idsip)->with('pegawai')->first();

            $d['jenispermohonan'] = JenisPermohonan::where('idprofesi', $d['sip']->pegawai->idprofesi)
                ->where('syarat', 9)->get();
            $d['syarat'] = $this->dataSyaratKitir($d['jenispermohonan'][0]->syarat);
        } else {
            $d['sip'] = SIP::where('id', $idsip)->with('pegawai')->first();
            $d['sip']->idjenispermohonan = $request->input('idjenispermohonan');
            $d['sip']->save();

            $d['jenispermohonan'] = JenisPermohonan::where('id', $request->input('idjenispermohonan'))->first();
            $d['syarat'] = $this->dataSyaratKitir($d['jenispermohonan']->syarat);
        }

        $d['subkoor'] = Pejabat::where('jabatan', 'Sub Koordinator')->first();
        $d['kabid'] = Pejabat::where('jabatan', 'Kepala Bidang')->first();
        $d['staf'] = Pejabat::where('id', $request->input('idpejabat'))->first();
        if ($d['sip']->saranapraktik == 'PRAKTIK MANDIRI') {
            $d['jumlah'] = $request->jumlah;
        } else {
            $d['jumlah'] = SIP::where('idspesialisasi', $d['sip']->idspesialisasi)->where('isactive', 1)
                ->where('idfaskes', $d['sip']->idfaskes)->get()->count();
        }

        return view('report.kitir', $d);
    }

    public function sip(Request $request, $idsip)
    {
        $d['sip'] = SIP::where('id', $idsip)->with('pegawai')->first();
        $d['kadinkes'] = Pejabat::where('jabatan', 'Kepala Dinas')->first();
        $d['jenispermohonan'] = JenisPermohonan::where('id', $d['sip']->idjenispermohonan)->first();

        return view('report.sipinterkon', $d);
    }

    public function surket($idsurket)
    {
        $d['surket'] = Surket::findOrFail($idsurket);
        $d['nakes'] = Pegawai::where('id', $d['surket']->idpegawai)->first(['id', 'nama', 'alamatktp', 'alamat', 'profesi']);
        if (isset($d['surket']->idsip)) {
            $idsip = explode(',', $d['surket']->idsip);
            $d['sip'] = SIP::whereIn('sip.id', $idsip)->leftJoin('mjenispermohonan', 'sip.idjenispermohonan', 'mjenispermohonan.id')
                ->get(['sip.id', 'nomor', 'namafaskes', 'alamatfaskes', 'nama']);
        } else {
            $d['sip'] = [];
        }
        $d['kadinkes'] = Pejabat::where('jabatan', 'Kepala Dinas')->first();

        return view('report.surket', $d);
    }

    private function dasarPeraturanPerstek($idprofesi)
    {
        $text = [];
        switch ($idprofesi) {
            case "1": // Dokter
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "2": // Dokter Gigi
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "3": // Dokter Spesialis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "4": // Dokter Gigi Spesialis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran."
                ];
                break;
            case "5": // PPDS (Program Pendidikan Dokter Spesialis)
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran.",
                    "Surat Edaran Nomor HK.03.03/MENKES/274/2014 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran",
                ];
                break;
            case "6": // PPDGS (Program Pendidikan Dokter Gig Spesialis)
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran.",
                    "Surat Edaran Nomor HK.03.03/MENKES/274/2014 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran",
                ];
                break;
            case "7": // Dokter Internship
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor  2052 / Menkes / Per / X / 2011 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran.",
                    "Surat Edaran Nomor HK.03.03/MENKES/274/2014 Tentang Izin Praktik dan Pelaksanaan Praktik Kedokteran",
                ];
                break;
            case "8": // Psikologi Klinis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 45 Tahun 2017 Tentang Izin dan Penyelenggaraan Praktik Psikolog Klinis",
                ];
                break;
            case "9": // Perawat
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 26 Tahun 2019 Tentang Peraturan Pelaksanaan Undang-Undang Nomor 38 Tahun 2014 tentang Keperawatan.",
                ];
                break;
            case "10": // Bidan
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 28 Tahun 2017 Tentang Izin dan Penyelenggaraan Pekerjaan dan Praktik Bidan",
                ];
                break;
            case "11": // Apoteker
                $text = [
                    "Peraturan Pemerintahan Nomor 51 Tahun 2009 tentang Pekerjaan Kefarmasian,",
                    "Peraturan Menteri Kesehatan Nomor 31 Tahun 2016 tentang Perubahan Atas Peraturan Menteri Kesehatan Nomor 889/Menkes/Per/V/2011 tentang Registrasi Izin Praktik, dan Izin Kerja Tenaga Kefarmasian;",
                    "Surat Edaran Nomor HK.02.02/MENKES/24/2017 tentang Petunjuk Pelaksanaan Peraturan Menteri Kesehatan Nomor 31 Tahun 2016;",
                ];
                break;
            case "12": // Tenaga Teknis Kefarmasian
                $text = [
                    "Peraturan Pemerintahan Nomor 51 Tahun 2009 tentang Pekerjaan Kefarmasian,",
                    "Peraturan Menteri Kesehatan Nomor 31 Tahun 2016 tentang Perubahan Atas Peraturan Menteri Kesehatan Nomor 889/Menkes/Per/V/2011 tentang Registrasi Izin Praktik, dan Izin Kerja Tenaga Kefarmasian;",
                    "Surat Edaran Nomor HK.02.02/MENKES/24/2017 tentang Petunjuk Pelaksanaan Peraturan Menteri Kesehatan Nomor 31 Tahun 2016;",
                ];
                break;
            case "13": // Sanitasi Lingkungan
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 32 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Tenaga Sanitarian",
                ];
                break;
            case "14": // Nutrisionis/Dietisien
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 26 Tahun 2013 Tentang Izin dan Penyelenggaraan Praktik Tenaga Gizi",
                ];
                break;
            case "15": // Fisioterapis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 80 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Fisioterapis",
                ];
                break;
            case "16": // Okupasi Terapis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 23 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Okupasi Terapis",
                ];
                break;
            case "17": // Terapis Wicara
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 24 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Terapis Wicara",
                ];
                break;
            case "18": // Akupunktur Terapis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia  Nomor 34 Tahun 2018 tentang Izin dan Penyelenggaraan Praktik Akupunktur Terapis."
                ];
                break;
            case "19": // Perekam Medis dan Informasi Kesehatan
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 55 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Perekam Medis",
                ];
                break;
            case "20": // Teknik Kardiovaskuler
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 30 Tahun 2015 Tentang Izin dan Penyelenggaraan Praktik Teknisi Kardiovasuler",
                ];
                break;
            case "21": // Refraksionis Optisien/Optometris
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 19 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Refraksionis Optisien dan Optometris",
                ];
                break;
            case "22": // Teknisi Gigi
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 54 Tahun 2012 Tentang Penyelenggaraan Pekerjaan Teknisi Gigi",
                ];
                break;
            case "23": // Penata Anestesi
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 18 Tahun 2016 Tentang Izin dan Penyelenggaraan Praktik Penata Anestesi",
                ];
                break;
            case "24": // Terapis Gigi dan Mulut
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 20 Tahun 2016 Tentang Izin dan Penyelenggaraan Praktik Terapis Gigi dan Mulut",
                ];
                break;
            case "25": // Radiografer
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 81 Tahun 2013 Tentang Penyelenggaraan Pekerjaan Radiografer",
                ];
                break;
            case "26": // Elektromedis
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 45 Tahun 2015 Tentang Izin dan Penyelenggaraan Praktik Elektromedis",
                ];
                break;
            case "27": // Ahli Teknologi Laboratorium Medik
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 42 Tahun 2015 Tentang Izin dan Penyelenggaraan Praktik Ahli Teknologi Laboratorium Medik",
                ];
                break;
            case "28": // Ortotik Prostetik
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 22 Tahun 2013 Tentang Penyelenggaraan Pekerjaan dan Praktik Ortotis Prostetis",
                ];
                break;
            case "29": // Tenaga Kesehata Tradisional
                $text = [
                    "Peraturan Pemerintah Republik Indonesia Nomor 103 Tahun 2014 Tentang Pelayanan Kesehatan Tradisional",
                ];
                break;
            case "30": // Tenaga Kesehata Tradisional Jamu
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 24 Tahun 2018 Tentang Izin dan Penyelenggaraan Praktik Tenaga Kesehatan Tradisional Jamu",
                ];
                break;
            case "31": // Tenaga Kesehata Tradisional Interkontinental
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 17 Tahun 2021 Tentang Izin dan Penyelenggaraan Praktik Tenaga Kesehatan Tradisional Interkontinental"
                ];
                break;
            case "32": // Penyehat Tradisional
                $text = [
                    "Peraturan Menteri Kesehatan Republik Indonesia Nomor 61 Tahun 2016 tentang Pelayanan Kesehatan Tradisional Empiris"
                ];
                break;
        }

        array_push($text, "Peraturan Walikota Surabaya Nomor 41 Tahun 2021 tentang Perizinan Berusaha, Perizinan Non Berusaha dan Pelayanan Non Perizinan");

        return $text;
    }

    private function dataSyaratKitir($idsyarat)
    {
        $syarat = [];
        switch ($idsyarat) {
            // Perorang Ijin Baru 
            case "1":
                $syarat = [
                    'KTP',
                    'Domisili',
                    'STR Legalisir',
                    'Ijazah Legalisir',
                    'Rekomendasi Organisasi Profesi',
                    'Surat Sehat',
                    'Pas Photo digital terbaru Ukuran 4 x 6 cm (tata letak harus tegak horisontal, tidak boleh miring)',
                    'Surat Pernyataan Tempat Bekerja',
                    'Surat Pengantar Puskesmas',
                    'Denah Ruangan dan Peta Lokasi'
                ];
                break;
            // Perorang Perpanjang
            case "2":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'STR Legalisir',
                    'Ijazah Legalisir',
                    'Rekomendasi Organisasi Profesi',
                    'Surat Sehat',
                    'Pas Photo digital terbaru Ukuran 4 x 6 cm (tata letak harus tegak horisontal, tidak boleh miring)',
                    'Surat Pernyataan Tempat Bekerja',
                    'Surat Pengantar Puskesmas',
                    'Denah Ruangan dan Peta Lokasi',
                    'SIP/SIK Lama asli'
                ];
                break;
            // Perorang Cabut
            case "3":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'SIP/SIK yang asli sesuai dengan yang akan dicabut',
                    'Surat Keterangan tidak bekerja dari Sarana yang sebelumnya (apabila bekerja di Sarana Kesehatan)',
                    'Berita Acara Pencabutan'
                ];
                break;
            // Perorang Cabut Pindah
            case "4":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'STR Legalisir',
                    'Ijazah Legalisir',
                    'Rekomendasi Organisasi Profesi',
                    'Surat Sehat',
                    'Pas Photo digital terbaru Ukuran 4 x 6 cm (tata letak harus tegak horisontal, tidak boleh miring)',
                    'Surat Pernyataan Tempat Bekerja',
                    'Surat Pengantar Puskesmas',
                    'Denah Ruangan dan Peta Lokasi',
                    'SIP/SIK yang asli sesuai dengan yang akan dicabut',
                    'Surat Keterangan tidak bekerja dari Sarana yang sebelumnya (apabila bekerja di Sarana Kesehatan)',
                    'Berita Acara Pencabutan'
                ];
                break;
            // Sarana Ijin Baru
            case "5":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'STR Legalisir',
                    'Ijazah Legalisir',
                    'Rekomendasi Organisasi Profesi',
                    'Surat Sehat',
                    'Pas Photo digital terbaru Ukuran 4 x 6 cm (tata letak harus tegak horisontal, tidak boleh miring)',
                    'Surat Pernyataan Tempat Bekerja',
                    'Surat Keterangan Bekerja dari Pimpinan, beserta izin Operasional Sarana Kesehatan'
                ];
                break;
            // Sarana Perpanjang
            case "6":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'STR Legalisir',
                    'Ijazah Legalisir',
                    'Rekomendasi Organisasi Profesi',
                    'Surat Sehat',
                    'Pas Photo digital terbaru Ukuran 4 x 6 cm (tata letak harus tegak horisontal, tidak boleh miring)',
                    'Surat Pernyataan Tempat Bekerja',
                    'Surat Keterangan Bekerja dari Pimpinan, beserta izin Operasional Sarana Kesehatan',
                    'SIP/SIK Lama asli'
                ];
                break;
            // Sarana Cabut
            case "7":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'SIP/SIK yang asli sesuai dengan yang akan dicabut',
                    'Surat Keterangan tidak bekerja dari Sarana yang sebelumnya (apabila bekerja di Sarana Kesehatan)',
                    'Berita Acara Pencabutan'
                ];
                break;
            // Sarana Cabut Pindah
            case "8":
                $syarat = [
                    'KTP',
                    'Surat Keterangan domisili tinggal di Surabaya (Bagi Penduduk Non Surabaya)',
                    'STR Legalisir',
                    'Ijazah Legalisir',
                    'Rekomendasi Organisasi Profesi',
                    'Surat Sehat',
                    'Pas Photo digital terbaru Ukuran 4 x 6 cm (tata letak harus tegak horisontal, tidak boleh miring)',
                    'Surat Pernyataan Tempat Bekerja',
                    'Surat Keterangan Bekerja dari Pimpinan, beserta izin Operasional Sarana Kesehatan',
                    'SIP/SIK yang asli sesuai dengan yang akan dicabut',
                    'Surat Keterangan tidak bekerja dari Sarana yang sebelumnya (apabila bekerja di Sarana Kesehatan)',
                    'Berita Acara Pencabutan'
                ];
                break;
            // Surat Keterangan
            case "9":
                $syarat = [
                    'Kartu Tanda Penduduk (KTP) Bagi Penduduk Non Surabaya',
                    'Copy SIP (Surat Izin Praktek) tempat praktik pertama/kedua untuk permohonan SIP tempat kedua/ketiga (Bagi yang memiliki SIP di Surabaya)',
                    'STR (Surat Tanda Registrasi) yang dilegalisasi asli, bagi PPDS/PPDGS STR lembar pertama (Bagi yang tidak memiliki SIP di Surabaya)',
                    'Surat Pernyataan Tidak mempunyai SIP (Bagi yang tidak memiliki SIP di Surabaya)'
                ];
                break;
        }
        return $syarat;
    }
}