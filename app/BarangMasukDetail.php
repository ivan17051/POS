<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasukDetail extends Model
{
    protected $table = 'barang_masuk_detail';

    public $timestamps = false;

    protected $fillable = [
        "tanggal",
        "nomor",
        "idsupplier",
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
