<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosaGejala extends Model
{
    protected $table = 'diagnosa_gejala';

    public $timestamps = false;

    protected $fillable = [
        'diagnosa_id',
        'gejala_id',
        'nilai_user'
    ];

    public function diagnosa()
    {
        return $this->belongsTo(Diagnosa::class);
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}