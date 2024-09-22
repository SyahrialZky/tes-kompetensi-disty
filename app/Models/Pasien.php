<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nama_pasien',
        'nik',
        'telp',
        'jenis_pasien',
        'jenis_periksa',
        'tgl_periksa',
    ];
}
