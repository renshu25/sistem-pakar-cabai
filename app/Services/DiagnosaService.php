<?php

    namespace App\Services;

    use App\Models\Penyakit;
    use App\Models\Gejala;
    use App\Models\Diagnosa;
    use Illuminate\Support\Facades\Auth;

    class DiagnosaService
    {

        public function prosesDiagnosa(array $inputGejala): array
        {

            $inputGejala = array_map('trim', $inputGejala);


            // ==============================
            // BOBOT GEJALA WP
            // ==============================

            $bobot = Gejala::pluck(
                'bobot',
                'kode_gejala'
            )->toArray();



            // ==============================
            // RULE BASED
            // ==============================

$rules = [

    'P001' => [
        ['G01','G03','G07'],
        ['G01','G06','G07'],
        ['G03','G06','G07'],
        ['G01','G03'],
        ['G01','G07'],
        ['G03','G07'],
        ['G03','G06'],
        ['G01','G06'],
    ],

    'P002' => [
        ['G02','G04','G10'],
        ['G02','G10'],
        ['G04','G10'],
        ['G02','G04'],
        ['G02','G03'],
        ['G02','G03','G10'],
    ],

    'P003' => [
        ['G06','G07','G08'],
        ['G07','G08'],
        ['G06','G08'],
        ['G06','G07'],
    ],

    'P004' => [
        ['G01','G02','G05'],
        ['G02','G05'],
        ['G01','G05'],
        ['G01','G02'],
        ['G01','G02','G05'],
    ],

    'P005' => [
        ['G09','G10'],
        ['G03','G09'],
        ['G09','G10','G03'],
        ['G04','G09','G10'],
    ],

];



            // ==============================
            // SELEKSI KANDIDAT RULE-BASED
            // ==============================

            $kandidat=[];


            foreach($rules as $kode=>$variasi){

                $maksimalCocok=0;


foreach($variasi as $kombinasi){

    $jumlahCocok = count(
        array_intersect(
            $kombinasi,
            $inputGejala
        )
    );


    if($jumlahCocok == count($kombinasi)){

        $maksimalCocok = 1;

        break;

    }

}


if($maksimalCocok == 1){

    $kandidat[$kode] = 1;

}

            }




$ranking=[];


// Tidak ada kandidat
if(count($kandidat)==0){

    return [

        'diagnosa'=>null,

        'ranking'=>[],

       'pesan'=>'Gejala yang dipilih belum cukup untuk menghasilkan diagnosis. Silakan pilih gejala lain yang sesuai dengan kondisi tanaman.'

    ];

}


// Hanya 1 kandidat
elseif(count($kandidat)==1){


    $kodeTerpilih=array_key_first($kandidat);


    $penyakit=Penyakit::where(
        'kode_penyakit',
        $kodeTerpilih
    )->firstOrFail();


    $ranking=[

        [

            'kode_penyakit'=>$kodeTerpilih,

            'nama_penyakit'=>$penyakit->nama_penyakit,

            'nilai_v'=>1

        ]

    ];


}


// Lebih dari 1 kandidat → WP

else{


    $matriks=[];


    $vektorS=[];

    $totalS=0;



    foreach($kandidat as $kode=>$nilai){


$gejalaPenyakit=[];


foreach($rules[$kode] as $rule){

if(count(array_intersect($rule,$inputGejala)) == count($rule)){

    if(count($rule) > count($gejalaPenyakit)){

        $gejalaPenyakit=$rule;

    }

}

}

        $S=1;


        foreach($inputGejala as $g){


            $x=in_array(
                $g,
                $gejalaPenyakit
            )
            ? 1
            : 0.1;


            $S *= pow(
                $x,
                $bobot[$g] ?? 0
            );


        }


        $vektorS[$kode]=$S;

        $totalS += $S;


    }



    foreach($vektorS as $kode=>$nilai){


        $penyakit=Penyakit::where(
            'kode_penyakit',
            $kode
        )->first();


        $ranking[]=[

            'kode_penyakit'=>$kode,

            'nama_penyakit'=>$penyakit->nama_penyakit ?? '-',

            'nilai_v'=>$nilai/$totalS

        ];


    }


    usort($ranking,function($a,$b){

        return $b['nilai_v'] <=> $a['nilai_v'];

    });


}


            // ==============================
            // HASIL AKHIR
            // ==============================


            if(count($ranking)==0){

                return [

                    'diagnosa'=>null,

                    'ranking'=>[],

                    'pesan'=>'Tidak ditemukan hasil diagnosa.'

                ];

            }



            $kodeTerpilih =
                $ranking[0]['kode_penyakit'];



            $penyakit=Penyakit::where(

                'kode_penyakit',

                $kodeTerpilih

            )->firstOrFail();



            $nilaiAkhir =
                $ranking[0]['nilai_v'];




            // ==============================
            // SIMPAN DIAGNOSA
            // ==============================


            $diagnosa=Diagnosa::create([


                'user_id'=>Auth::id(),


                'penyakit_id'=>$penyakit->id,


                'nama_user'=>Auth::user()->name,


                'nilai_hasil'=>$nilaiAkhir,


                'keterangan'=>
                    $this->getKeterangan(
                        $nilaiAkhir
                    ),


            ]);





            // simpan gejala user


            foreach($inputGejala as $kode){


                $g=Gejala::where(

                    'kode_gejala',

                    $kode

                )->first();



                if($g){


                    $diagnosa->gejala()->attach(

                        $g->id,

                        [

                            'nilai_user'=>1

                        ]

                    );

                }


            }




            return [


                'diagnosa'=>

                    $diagnosa->load([

                        'penyakit.obat',

                        'gejala'

                    ]),



                'ranking'=>$ranking


            ];



        }




        private function getKeterangan($nilai)

        {


            if($nilai >= 0.24){

                return "Kemungkinan Tinggi";

            }


            if($nilai >= 0.18){

                return "Kemungkinan Sedang";

            }


            return "Kemungkinan Rendah";


        }


    }