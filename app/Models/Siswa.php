<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'nis';
    public $incrementing = false; // NIS biasanya bukan auto-increment

    protected $fillable = [
        'nis',
        'username',
        'password',
        'kelas',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi ke Aspirasi (Siswa punya banyak laporan)
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'nis', 'nis');
    }
}