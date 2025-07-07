<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    public $timestamps = true; 

    protected $fillable = [
        'nomor_surat',
        'hari',
        'tanggal',
        'jam',
        'gender',
        'nama',
        'ttg',
        'pekerjaan',
        'alamat',
        'domisili',
        'no_hp',
        'nik',
        'tujuan',
        'tempat_kejadian',
        'tanggal_kejadian',
        'kerugian',
        'teradu',
        'korban',
        'modus',
        'keterangan',
        'penerima',
        'jabatan',
        'nrp',
    ];
}
