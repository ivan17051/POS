<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'mbarang';

    public $timestamps = false;

    protected $fillable = [
        "idkategori",
        "namabarang",
        "kodebarang",
        "expired",
        "harga_1",
        "harga_3",
        "harga_6",
        "lokasi",
        "istitipan",
    ];

    public function getKategori(){
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
}
