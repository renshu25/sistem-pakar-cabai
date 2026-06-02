<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PenyakitGejala extends Model {
    protected $table    = 'penyakit_gejala'; // ganti dari basis_pengetahuan
    protected $fillable = ['kode_rule', 'penyakit_id', 'gejala_id', 'bobot_gejala'];
    public function penyakit(){ return $this->belongsTo(Penyakit::class); }
    public function gejala()  { return $this->belongsTo(Gejala::class); }
}