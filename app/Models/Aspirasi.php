<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasis';

    protected $fillable = [
        'nis',
        'id_kategori',
        'lokasi',
        'ket',
        'foto',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke Tanggapan (Satu laporan punya satu tanggapan/status)
    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_aspirasi', 'id');
    }
}