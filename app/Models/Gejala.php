<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model {
    protected $table    = 'gejala';
    protected $fillable = ['kode_gejala', 'nama_gejala', 'bobot'];

    public function penyakit()        { return $this->belongsToMany(Penyakit::class, 'basis_pengetahuan')->withPivot('bobot_gejala', 'kode_rule'); }
    public function basisPengetahuan(){ return $this->hasMany(BasisPengetahuan::class); }
}