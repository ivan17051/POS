<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PTMOU extends Model
{
    protected $table = 'mptmou';

    public $timestamps = false;

    protected $fillable = [
        "nama",
    ];
}
