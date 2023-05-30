<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';

    public $timestamps = false;

    protected $fillable = [
        "tanggal",
        "nomor",
        "idsupplier",
        "metode",
        "jumlah",
        "tgljatuhtempo",
        "islunas",
    ];

    public function getSupplier(){
        return $this->belongsTo(Supplier::class, 'idsupplier');
    }
}
