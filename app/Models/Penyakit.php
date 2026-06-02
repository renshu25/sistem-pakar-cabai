<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model {
    protected $table = 'penyakit';
    protected $fillable = ['kode_penyakit', 'nama_penyakit', 'deskripsi'];

    public function gejala()          { return $this->belongsToMany(Gejala::class, 'basis_pengetahuan')->withPivot('bobot_gejala', 'kode_rule'); }
    public function obat()            { return $this->belongsToMany(Obat::class, 'penyakit_obat'); }
    public function basisPengetahuan(){ return $this->hasMany(BasisPengetahuan::class); }
    public function diagnosa()        { return $this->hasMany(Diagnosa::class); }
}