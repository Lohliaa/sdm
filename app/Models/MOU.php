<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOU extends Model
{
    use HasFactory;
    protected $table = "mou";
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_sk',
        'no_tambahan',
        'status_kepegawaian',
        'status_detail',
        'nama',
        'gelar',
        'hari_kerja',
        'jam_kerja',
        'alamat',
        'hari',
        'tgl_mou',
        'tempat_lahir',
        'tanggal_lahir',
        'unit_kerja',
        'gaji_pokok',
        'tunjangan_jabatan',
        'tunjangan_transport',
        'tunjangan_kinerja',
        'tunjangan_fungsional',
        'thp',
        'terbilang',
        'tgl_mulai',
        'berlaku',
        'tanggal_akhir',
        'saksi1',
        'saksi2'

    ];
}
