<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model {
    protected $table    = 'diagnosa';
    protected $fillable = ['user_id', 'penyakit_id', 'nama_user', 'nilai_hasil', 'keterangan'];

    public function user()    { return $this->belongsTo(User::class); }
    public function penyakit(){ return $this->belongsTo(Penyakit::class); }
    public function gejala()  { return $this->belongsToMany(Gejala::class, 'diagnosa_gejala')->withPivot('nilai_user'); }
}