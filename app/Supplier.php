<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'msupplier';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "alamat",
        "email",
        "notelp",
    ];
}
