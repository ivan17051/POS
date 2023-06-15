<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $table = 'stokopname';

    public $timestamps = false;

    protected $fillable = [
        "nomor",
        "tanggal",
        "petugas",
        "status",
    ];

}
