<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KecamatanKelurahan extends Model
{
    protected $table = 'mkec_kel';

    public $timestamps = false;

    protected $fillable = [
        "wilayah",
        "nama_kec",
        "nama_kel",
    ];
}
