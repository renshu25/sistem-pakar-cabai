<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyakitGejala extends Model
{
    protected $table = 'basis_pengetahuan';

    protected $fillable = ['kode_rule', 'penyakit_id', 'gejala_id', 'bobot_gejala'];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}