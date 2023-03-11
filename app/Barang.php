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
    ];

    public function getKategori(){
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
}
