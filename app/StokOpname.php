<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $table = 'stokopname';

    public $timestamps = false;

    protected $fillable = [
        "idbarang",
        "tanggal",
        "stok",
        "stokreal",
        "selisih",
        "isfinal",
    ];

    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
    public function getSupplier(){
        return $this->belongsTo(Supplier::class, 'idsupplier');
    }
}
