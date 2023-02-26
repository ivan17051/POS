<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    protected $table = 'mfaskes';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "idkategori",
        "alamat",
        "kecamatan",
        "kelurahan",
        "coord_x",
        "coord_y",
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idpegawai');
    }
}
