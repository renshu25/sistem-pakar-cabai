<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model {
    protected $table    = 'obat';
    protected $fillable = ['kode_obat', 'nama_obat', 'keterangan'];

    public function penyakit(){ return $this->belongsToMany(Penyakit::class, 'penyakit_obat'); }
}