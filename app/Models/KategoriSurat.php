<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    use HasFactory;
    protected $table = "kategori_surat";
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];

}
