<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    protected $table = 'mspesialisasi';

    public $timestamps = false;

    protected $fillable = [
        "idprofesi",
        "nama",
    ];
}
