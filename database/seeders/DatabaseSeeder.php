<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, Penyakit, Gejala, Obat, PenyakitGejala};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Users
        User::create(['name'=>'Admin Sistem','email'=>'admin@cabai.id','password'=>Hash::make('password'),'role'=>'admin']);
        User::create(['name'=>'Budi Santoso','email'=>'budi@petani.id','password'=>Hash::make('password'),'role'=>'user']);

        // Penyakit
// Penyakit
$penyakitData = [

    [
        'P001',
        'Layu Fusarium',
        'Penyakit layu yang disebabkan oleh jamur Fusarium oxysporum. Patogen menyerang jaringan pembuluh tanaman sehingga menghambat proses pengangkutan air dan unsur hara. Gejala utama ditandai dengan daun menguning, tanaman mengalami kelayuan, pertumbuhan terhambat, dan pada kondisi parah tanaman dapat mengalami kematian.'
    ],


    [
        'P002',
        'Antraknosa',
        'Penyakit yang disebabkan oleh jamur Colletotrichum spp. yang menyerang bagian buah, terutama pada kondisi lingkungan lembap. Gejala ditandai dengan munculnya bercak cekung berwarna gelap pada buah, perkembangan bercak semakin meluas, buah membusuk, serta menyebabkan penurunan kualitas dan hasil produksi cabai.'
    ],


    [
        'P003',
        'Busuk Akar',
        'Penyakit yang menyerang sistem perakaran tanaman cabai akibat infeksi patogen pada area akar. Serangan menyebabkan kerusakan jaringan akar sehingga kemampuan tanaman dalam menyerap air dan nutrisi menurun. Gejala yang muncul berupa tanaman layu, pertumbuhan tidak optimal, akar mengalami pembusukan, dan tanaman dapat mati secara bertahap.'
    ],


    [
        'P004',
        'Bercak Daun Alternaria',
        'Penyakit yang disebabkan oleh jamur Alternaria spp. yang menyerang bagian daun tanaman cabai. Infeksi menyebabkan munculnya bercak berbentuk tidak beraturan dengan warna coklat hingga kehitaman pada permukaan daun. Serangan berat dapat menyebabkan daun mengering, gugur, serta mengganggu proses fotosintesis tanaman.'
    ],


    [
        'P005',
        'Busuk Buah Basah',
        'Penyakit yang menyerang buah cabai akibat infeksi mikroorganisme patogen yang berkembang pada kondisi lembap. Gejala ditandai dengan buah mengalami pelunakan, perubahan warna, munculnya pembusukan berair, serta dapat menyebar dengan cepat sehingga menyebabkan kerusakan dan kehilangan hasil panen.'
    ],

];


foreach ($penyakitData as [$kode,$nama,$desk]) {

    Penyakit::create([

        'kode_penyakit'=>$kode,

        'nama_penyakit'=>$nama,

        'deskripsi'=>$desk

    ]);

}

        // Gejala
// Gejala
$gejalaData = [

    ['G01','Daun Menguning',0.167],

    ['G02','Bercak hitam pada daun',0.125],

    ['G03','Batang membusuk',0.083],

    ['G04','Buah keriput',0.125],

    ['G05','Daun Menggulung',0.083],

    ['G06','Pertumbuhan Lambat',0.042],

    ['G07','Akar Busuk/Berjamur',0.083],

    ['G08','Jamur Putih Pangkal Batang',0.083],

    ['G09','Buah Cabai Busuk Basah',0.083],

    ['G10','Bercak Coklat Pada Buah',0.125],

];


foreach ($gejalaData as [$kode,$nama,$bobot]) {

    Gejala::create([

        'kode_gejala'=>$kode,

        'nama_gejala'=>$nama,

        'bobot'=>$bobot

    ]);

}

        // Obat
        $obatData = [
            ['O001','Mankozeb 80%','Fungisida kontak, semprot tiap 7 hari'],
            ['O002','Klorotalonil 75%','Fungisida preventif sistemik'],
            ['O003','Imidakloprid 200 SL','Insektisida, kendalikan vektor kutu kebul'],
            ['O004','Metalaksil 35%','Fungisida sistemik, siram ke pangkal batang'],
            ['O005','Propineb 70% WP','Fungisida spektrum luas'],
            ['O006','Streptomisin Sulfat','Bakterisida untuk penyakit bakteri'],
        ];
        foreach ($obatData as [$kode,$nama,$ket]) {
            Obat::create(['kode_obat'=>$kode,'nama_obat'=>$nama,'keterangan'=>$ket]);
        }

        // Relasi penyakit-obat
$p = Penyakit::get()->keyBy('kode_penyakit');

$o = Obat::pluck('id','kode_obat');


// Layu Fusarium
$p['P001']->obat()->attach([
    $o['O004']
]);


// Antraknosa
$p['P002']->obat()->attach([
    $o['O001'],
    $o['O002'],
    $o['O005']
]);


// Busuk Akar
$p['P003']->obat()->attach([
    $o['O004']
]);


// Bercak Daun Alternaria
$p['P004']->obat()->attach([
    $o['O002']
]);


// Busuk Buah Basah
$p['P005']->obat()->attach([
    $o['O001'],
    $o['O005']
]);

// Basis Pengetahuan (Rules)

$g = Gejala::pluck('id','kode_gejala');

$rules = [


['R01',$p['P001']->id,$g['G01'],0.167],
['R02',$p['P001']->id,$g['G03'],0.083],
['R03',$p['P001']->id,$g['G07'],0.083],


['R04',$p['P002']->id,$g['G02'],0.125],
['R05',$p['P002']->id,$g['G04'],0.125],
['R06',$p['P002']->id,$g['G10'],0.125],


['R07',$p['P003']->id,$g['G06'],0.042],
['R08',$p['P003']->id,$g['G07'],0.083],
['R09',$p['P003']->id,$g['G08'],0.083],


['R10',$p['P004']->id,$g['G01'],0.167],
['R11',$p['P004']->id,$g['G02'],0.125],
['R12',$p['P004']->id,$g['G05'],0.083],


['R13',$p['P005']->id,$g['G09'],0.083],
['R14',$p['P005']->id,$g['G10'],0.125],
['R15',$p['P005']->id,$g['G03'],0.083],


];


foreach ($rules as [$kode,$pid,$gid,$bobot]) {


    PenyakitGejala::create([

        'kode_rule'=>$kode,

        'penyakit_id'=>$pid,

        'gejala_id'=>$gid,

        'bobot_gejala'=>$bobot

    ]);

}
    }
}