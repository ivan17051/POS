<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    public $timestamps = false;

    protected $fillable = [
        "idmember",
        "idbarang",
        "qty",
        "harga",
        "diskon",
        "total",
    ];

    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
}
