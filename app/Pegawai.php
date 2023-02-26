<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // use Traits\HasCompositePrimaryKey;

    // protected $primaryKey = ['id', 'idprofesi'];
    
    // public $incrementing = false;
    
    protected $table = 'mpegawai';

    public $timestamps = false;

    protected $casts = [
        'tanggallahir' => 'date',
    ];

    protected $guarded = [];

    protected $fillable = [
        "id",
        "nomorregis",
        "kodeprofesi",
        "nik",
        "nama",
        "tempatlahir",
        "tanggallahir",
        "jeniskelamin",
        "alamatktp",
        "alamat",
        "nohp",
        "idc",
        "idm",
        "provinsi",
        "kabkota",
        "kecamatan",
        "kelurahan",
        "perguruantinggi",
        "tahunlulus",
        "idprofesi",
        "idspesialisasi",
        "profesi",
        "spesialisasi",
        "foto",
    ];
    
    public function profesiTable(){
        return $this->belongsTo(Profesi::class, 'idprofesi');
    }

    public function spesialisasiTable(){
        return $this->belongsTo(Spesialisasi::class, 'idspesialisasi');
    }

    public function profesirelation()
    {
        return $this->belongsTo(Profesi::class, 'idprofesi');
    }
}
