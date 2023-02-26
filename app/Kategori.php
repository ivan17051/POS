<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'mkategori';

    public $timestamps = false;

    protected $fillable = [
        "nama",
    ];
}
