<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NIB extends Model
{
    protected $table = 'nib';

    public $timestamps = false;

    protected $fillable = [
        "idfaskes",
        "idkategori",
        "no_sertif",
        "nib",
        "pemohon",
        "since",
        "expiry",
        "tgl_terbit",
        "jenis",
        "idc",
        "doc",
        "idm",
        "dom",
    ];
}
