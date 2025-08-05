<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SK extends Model
{
    use HasFactory;
    protected $table = "sk";
    protected $primaryKey = 'id';
    protected $fillable =[
        'no_sk',
        'no_tambahan',
        'nama',
        'gelar',
        'tempat_lahir',
        'tanggal_lahir',
        'nipy',
        'gol_ruang',
        'status_kepegawaian',
        'unit_kerja',
        'tmt',
        'tanggal_mulai',
        'berlaku',
        'tanggal_akhir',
        'tanggal_ditetapkan'
    ];
    
}
