<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model {
    protected $table = 'gejala';
    protected $fillable = ['kode_gejala', 'nama_gejala', 'bobot'];

    // RELASI BALIK: Hubungkan gejala ke penyakit melalui tabel pivot penyakit_gejala
    public function penyakit() {
        return $this->belongsToMany(Penyakit::class, 'penyakit_gejala', 'gejala_id', 'penyakit_id')
                    ->withPivot('bobot_gejala', 'kode_rule')
                    ->withTimestamps();
    }
}