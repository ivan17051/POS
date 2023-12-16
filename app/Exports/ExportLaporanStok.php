<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
use Excel;

class ExportLaporanStok implements FromCollection, ShouldAutoSize
{
    protected $lokasi;

    function __construct($lokasi) {
            $this->lokasi = $lokasi;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // dd($this->lokasi);
        if($this->lokasi == 'semua'){
            // $data = Stok::with('getBarang:id,namabarang,kodebarang')->get(['id', 'idbarang', 'stok']);
            $query = 'SELECT A.idbarang, A.idsupplier, A.stok, B.lokasi, B.namabarang, B.kodebarang, Ca.h_sat AS hargabeli
                FROM stok A
                JOIN barang_masuk_detail Ca ON (A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier)
                JOIN mbarang B ON A.idbarang = B.id
                WHERE A.stok > 0';
        } else {
            $query = 'SELECT A.idbarang, A.idsupplier, A.stok, B.lokasi, B.namabarang, B.kodebarang, Ca.h_sat AS hargabeli
                FROM stok A
                JOIN barang_masuk_detail Ca ON A.idbarang = Ca.idbarang AND A.idsupplier = Ca.idsupplier
                JOIN mbarang B ON A.idbarang = B.id
                WHERE A.stok > 0 AND B.lokasi =\''.$this->lokasi.'\'';
        }

        $data = DB::select(DB::raw($query));
        // dd($data);
        return collect($data);
    }
}
