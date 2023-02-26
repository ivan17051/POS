<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPermohonan extends Model
{
    
    protected $table = 'mjenispermohonan';

    public $timestamps = false;

    protected $fillable = [
        "idprofesi",
        "nama",
    ];
    
}
