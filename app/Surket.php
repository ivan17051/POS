<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surket extends Model
{
    protected $table = 'surat';

    public $timestamps = false;

    protected $fillable = [
        "idpegawai",
        "idstr",
        "idsip",
        "nosurat",
        "tglsurat",
        "noonline",
        "tglonline",
        "tglverif",
        "kotatujuan",
        "idc",
        "doc",
        "idm",
        "dom",
    ];

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'idpegawai');
    }
}
