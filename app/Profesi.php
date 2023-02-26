<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesi extends Model
{
    protected $table = 'mprofesi';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "makssip",
        "isparent",
    ];
}
