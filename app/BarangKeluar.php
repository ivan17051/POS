<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';

    public $timestamps = false;

    protected $fillable = [
        "tanggal",
        "nomor",
        "idmember",
        "metode",
        "jumlah",
        "diskon",
        "poin",
        "bayar",
        "keterangan",
    ];

    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
    public function getMember(){
        return $this->belongsTo(Member::class, 'idmember');
    }
}
