<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    protected $table = 'retur';

    public $timestamps = false;

    protected $fillable = [
        "id_barangmasuk",
        "id_detailbarangmasuk",
        "tanggal",
        "nomor",
        "jumretur",
    ];

    public function getNomor(){
        return $this->belongsTo(BarangMasuk::class, 'id_barangmasuk');
    }
}
