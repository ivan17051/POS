<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';

    public $timestamps = false;

    protected $fillable = [
        "idbarang",
        "idsupplier",
        "qtyin",
        "qtyout",
        "stok",
    ];

    public function getBarang(){
        return $this->belongsTo(Barang::class, 'idbarang');
    }
    public function getSupplier(){
        return $this->belongsTo(Supplier::class, 'idsupplier');
    }
}
