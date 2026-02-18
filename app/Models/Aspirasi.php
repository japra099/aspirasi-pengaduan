<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'kelas',
        'kategori_pengaduan',
        'detail_pengaduan',
        'foto_sarana',
        'status',
        'umpan_balik'
    ];
}