<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIP extends Model
{
    protected $table = 'sip';

    public $timestamps = false;

    protected $fillable = [
        "idstr",
        "idpegawai",
        "nomorregis",
        "idprofesi",
        "idspesialisasi",
        "nomorstr",
        "expirystr",

        "saranapraktik",
        "faskes",
        "namafaskes",
        "alamatfaskes",

        "idwilayahpkm",
        "idptmou",
        "nomormou",
        "masamou",

        "instance",
        "iterator",
        "nomor",
        "nomorrekom",
        "nomoronline",
        "idfaskes",
        "jadwalpraktik",
        "idjenispermohonan",
        "jenispermohonan",
        "jabatan",
        "tglonline",
        "tglmasukdinas",
        "tglverif",
        "tglsurat",
        "tgldeactive",
        "isactive",
        "idc",
        "idm",

    ];
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idpegawai');
    }

    public function profesirelation()
    {
        return $this->belongsTo(Profesi::class, 'idprofesi');
    }

    public function puskesmas(){
        return $this->belongsTo(Faskes::class, 'idwilayahpkm');
    }

    public function spesialisasi(){
        return $this->belongsTo(Spesialisasi::class, 'idspesialisasi');
    }

    public function ptmou(){
        return $this->belongsTo(PTMOU::class, 'idptmou');
    }
}
