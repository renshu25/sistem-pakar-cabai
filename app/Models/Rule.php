<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Rule.php
class Rule extends Model
{
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function details()
    {
        return $this->hasMany(RuleDetail::class); // pastikan nama model benar
    }
}
