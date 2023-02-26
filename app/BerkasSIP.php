<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BerkasSIP extends Model
{
    protected $table = 'berkassip';

    public $timestamps = false;

    protected $fillable = [
        "idsip",
        "url",
        "keterangan",
    ];
}
