<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    
    protected $table = 'mpejabat';

    public $timestamps = false;

    protected $fillable = [
        "nip",
        "nama",
        "jabatan",
        "pangkat",
        "isactive",
    ];
    
}
