<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STR extends Model
{
    protected $table = 'str';

    public $timestamps = false;

    protected $fillable = [
        "idpegawai",
        "nomorregis",
        "idprofesi",
        "idspesialisasi",
        "nomor",
        "since",
        "expiry",
        "tanggal",
        "idc",
        "idm",
        "isactive",
    ];
    
    /**
     * Get the Pegawai that owns the STR
     *
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idpegawai');
    }
    /**
     * Get the Profesi Name
     *
     */
    public function profesi()
    {
        return $this->belongsTo(Profesi::class, 'idprofesi');
    }

    public function berakhir(){
        return $this->belongsTo(Berakhir::class, 'expiry', 'tanggal');
    }
    public function spesialisasi(){
        return $this->belongsTo(Spesialisasi::class, 'idspesialisasi');
    }
}