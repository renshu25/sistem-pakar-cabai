<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/RuleDetail.php
class RuleDetail extends Model
{
    protected $table = 'rule_details'; // pastikan nama tabel sesuai DB

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}