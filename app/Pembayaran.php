<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    public $timestamps = false;

    protected $fillable = [
        "idbarangmasuk",
        "nokwitansi",
        "tanggal",
        "jumbayar",
    ];
}
