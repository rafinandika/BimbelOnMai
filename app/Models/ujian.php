<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Pastikan import Model User

class Ujian extends Model
{
    protected $table = 'ujians'; // Opsional, untuk memastikan nama tabel

    protected $fillable = [
        'nama_ujian',
        'mapel',
        'kelas',
        'deskripsi',
        'acak_soal',
        'acak_jawaban',
        'tampilkan_hasil',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }
}