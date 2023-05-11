<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    protected $table = 'barang_keluar_detail';

    public $timestamps = false;

    protected $fillable = [
        "idtransaksi",
        "tanggal",
        "nomor",
        "idmember",
        "idbarang",
        "qty",
        "h_sat",
        "jumlah",
    ];

    public function getSupplier(){
        return $this->belongsTo(Supplier::class, 'idsupplier');
    }
    public function getBarangMasuk(){
        return $this->belongsTo(BarangMasuk::class, 'nomor', 'nomor');
    }
    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
}
