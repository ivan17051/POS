<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    public $timestamps = false;

    protected $fillable = [
        "idbarang",
        "qty",
        "harga_satuan",
        "total",
    ];

    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
}
