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
        $penyakitData = [
            ['P001','Antraknosa','Penyakit jamur Colletotrichum capsici yang menyebabkan bercak hitam pada buah cabai.'],
            ['P002','Busuk Phytophthora','Disebabkan Phytophthora capsici, menyerang akar, batang, dan buah.'],
            ['P003','Layu Fusarium','Jamur Fusarium oxysporum menyumbat pembuluh air tanaman hingga layu.'],
            ['P004','Virus Kuning (Gemini)','Ditularkan oleh kutu kebul, daun menguning dan menggulung ke atas.'],
            ['P005','Bercak Daun Cercospora','Jamur Cercospora capsici membentuk bercak putih di tengah daun.'],
            ['P006','Layu Bakteri','Ralstonia solanacearum menyebabkan tanaman layu mendadak total.'],
        ];
        foreach ($penyakitData as [$kode,$nama,$desk]) {
            Penyakit::create(['kode_penyakit'=>$kode,'nama_penyakit'=>$nama,'deskripsi'=>$desk]);
        }

        // Gejala
        $gejalaData = [
            ['G001','Bercak hitam / coklat pada buah',0.8],
            ['G002','Daun menguning (klorosis)',0.7],
            ['G003','Tanaman layu mendadak',0.9],
            ['G004','Buah busuk lunak berair',0.6],
            ['G005','Daun menggulung ke atas',0.6],
            ['G006','Pembuluh batang berwarna coklat',0.8],
            ['G007','Bercak putih bersalut abu pada daun',0.5],
            ['G008','Kutu kebul pada permukaan bawah daun',0.9],
            ['G009','Buah berubah warna sebelum masak',0.5],
            ['G010','Akar membusuk berwarna coklat kehitaman',0.7],
        ];
        foreach ($gejalaData as [$kode,$nama,$bobot]) {
            Gejala::create(['kode_gejala'=>$kode,'nama_gejala'=>$nama,'bobot'=>$bobot]);
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

$p['P001']->obat()->attach([$o['O001'],$o['O002'],$o['O005']]);
$p['P002']->obat()->attach([$o['O004']]);
$p['P004']->obat()->attach([$o['O003']]);
$p['P006']->obat()->attach([$o['O006']]);

        // Basis Pengetahuan (Rules)
        $g = Gejala::pluck('id','kode_gejala');
$rules = [
 ['R001',$p['P001']->id,$g['G001'],0.8],
 ['R002',$p['P001']->id,$g['G004'],0.7],
 ['R003',$p['P001']->id,$g['G009'],0.5],

 ['R004',$p['P002']->id,$g['G004'],0.8],
 ['R005',$p['P002']->id,$g['G010'],0.7],

 ['R006',$p['P003']->id,$g['G003'],0.6],
 ['R007',$p['P003']->id,$g['G006'],0.8],

 ['R008',$p['P004']->id,$g['G002'],0.9],
 ['R009',$p['P004']->id,$g['G005'],0.6],
 ['R010',$p['P004']->id,$g['G008'],0.9],

 ['R011',$p['P005']->id,$g['G007'],0.7],

 ['R012',$p['P006']->id,$g['G003'],0.9],
 ['R013',$p['P006']->id,$g['G006'],0.5],
];
foreach ($rules as [$kode,$pid,$gid,$bobot]) {
    PenyakitGejala::create([
        'kode_rule'     => $kode,
        'penyakit_id'   => $pid,
        'gejala_id'     => $gid,
        'bobot_gejala'  => $bobot
    ]);
}
    }
}