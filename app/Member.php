<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'mmember';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "alamat",
        "notelp",
        "poin",
    ];
}
