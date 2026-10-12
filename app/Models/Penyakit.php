<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $table = 'penyakit';

    protected $fillable = [
        'kode_penyakit',
        'nama_penyakit',
        'deskripsi',
    ];

    /**
     * 💡 TAMBAHKAN FUNGSI INI
     * Relasi One-to-Many ke Model Diagnosa
     */
    public function diagnosa()
    {
        // Pastikan nama class modelnya 'Diagnosa' sesuai dengan file di app/Models/Diagnosa.php
        // Dan pastikan foreign key di tabel diagnosa adalah 'penyakit_id'
        return $this->hasMany(Diagnosa::class, 'penyakit_id');
    }

public function obat()
{
    // 🟢 Mengunci nama tabel perantara ke 'penyakit_obat'
    return $this->belongsToMany(Obat::class, 'penyakit_obat', 'penyakit_id', 'obat_id');
}

    /**
     * Relasi ke Gejala (Via Basis Pengetahuan)
     */
    public function gejala()
    {
        return $this->belongsToMany(Gejala::class, 'basis_pengetahuan', 'penyakit_id', 'gejala_id')
                    ->withPivot('bobot_gejala')
                    ->withTimestamps();
    }
}