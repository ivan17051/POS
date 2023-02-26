<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berakhir extends Model
{
    protected $table = 'mberakhir';

    public $timestamps = false;

    protected $fillable = [
        "idprofesi",
        "tanggal",
        "keterangan",
    ];

    public function profesi()
    {
        return $this->belongsTo(Profesi::class, 'idprofesi');
    }
}
