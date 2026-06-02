<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosaGejala extends Model
{
    protected $fillable = [
        'kode_gejala',
        'nama_gejala',
        'bobot'
    ];
}