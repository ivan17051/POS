<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokOpnameDetail extends Model
{
    protected $table = 'stokopname_detail';

    public $timestamps = false;

    protected $fillable = [
        "idstokopname",
        "idbarang",
        "tanggal",
        "stok",
        "stokreal",
        "selisih",
    ];

    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
    public function getStokOpname(){
        return $this->belongsTo(StokOpname::class, 'idstokopname');
    }
}
