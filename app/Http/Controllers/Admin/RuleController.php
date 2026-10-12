<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\PenyakitGejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
    /**
     * Menampilkan daftar rule. Setiap baris basis_pengetahuan adalah SATU
     * rule fisik (kode_rule unik). Untuk tampilan, baris-baris dikelompokkan
     * per penyakit_id agar terbaca sebagai "IF G01 AND G03 AND G07 THEN P01",
     * meski sebenarnya itu gabungan dari 3 rule (R01, R02, R03) yang berbeda.
     */
    public function index()
    {
        $gejalaData   = Gejala::orderBy('kode_gejala', 'asc')->get();
        $penyakitData = Penyakit::orderBy('kode_penyakit', 'asc')->get();

        // Ambil semua rule (1 baris = 1 rule), urut berdasarkan kode_rule
        $rows = PenyakitGejala::with(['penyakit', 'gejala'])
            ->orderBy('kode_rule')
            ->get();

        // Kelompokkan untuk TAMPILAN per penyakit (bukan untuk penyimpanan)
$rules = $rows->groupBy('kode_rule')->map(function ($group) {

    $first = $group->first();

    return (object)[

        'kode_rule' => $first->kode_rule,

        'penyakit' => $first->penyakit,

        'gejala' => $group->pluck('gejala'),

    ];

})->values();

        return view('admin.rule.index', compact('rules', 'gejalaData', 'penyakitData'));
    }

    /**
     * Menyimpan RULE BARU.
     * Setiap gejala yang dicentang menjadi SATU baris baru di basis_pengetahuan,
     * masing-masing dengan kode_rule UNIK sendiri (R16, R17, R18, ...).
     */
public function store(Request $request)
{
    $request->validate([
        'penyakit_id'  => 'required|exists:penyakit,id',
        'gejala_ids'   => 'required|array|min:1',
        'gejala_ids.*' => 'exists:gejala,id',
        'bobot_gejala' => 'nullable|numeric|min:0|max:1',
    ]);


    $penyakit  = Penyakit::findOrFail($request->penyakit_id);
    $gejalaIds = $request->gejala_ids;
    $bobot     = $request->input('bobot_gejala',1);


    $kodeRule = null;

DB::transaction(function () use ($penyakit,$gejalaIds,$bobot,&$kodeRule){

        // ambil kode rule berikutnya
        $last = PenyakitGejala::selectRaw(
            'MAX(CAST(SUBSTRING(kode_rule,2) AS UNSIGNED)) as max_num'
        )->value('max_num');


        $kodeRule = 'R'.str_pad(
            ($last ?? 0)+1,
            2,
            '0',
            STR_PAD_LEFT
        );


        // semua gejala memakai kode rule yang sama
        foreach($gejalaIds as $gejalaId){

            PenyakitGejala::create([
                'kode_rule'    => $kodeRule,
                'penyakit_id'  => $penyakit->id,
                'gejala_id'    => $gejalaId,
                'bobot_gejala' => $bobot,
            ]);

        }

    });


    return redirect()
        ->route('admin.rule.index')
        ->with(
            'success',
            "Rule {$kodeRule} berhasil ditambahkan"
        );
}
    /**
     * Memperbarui SATU baris rule (berdasarkan id baris, bukan kode_rule,
     * karena kode_rule unik per baris).
     */
    public function update(Request $request,$kodeRule)
{

$request->validate([
    'gejala_ids'=>'required|array',
    'gejala_ids.*'=>'exists:gejala,id'
]);


$rule = PenyakitGejala::where('kode_rule',$kodeRule)
    ->firstOrFail();


$penyakitId = $rule->penyakit_id;


// hapus gejala lama
PenyakitGejala::where('kode_rule',$kodeRule)
    ->delete();


// buat ulang
foreach($request->gejala_ids as $gejalaId){

    PenyakitGejala::create([

        'kode_rule'=>$kodeRule,

        'penyakit_id'=>$penyakitId,

        'gejala_id'=>$gejalaId,

        'bobot_gejala'=>1

    ]);

}


return redirect()
->route('admin.rule.index')
->with('success',"Rule $kodeRule berhasil diperbarui");

}
    /**
     * Menghapus SATU baris rule (berdasarkan id baris).
     */
public function destroy($kode_rule)
{

    PenyakitGejala::where('kode_rule',$kode_rule)->delete();


    return redirect()
        ->route('admin.rule.index')
        ->with(
            'success',
            "Rule {$kode_rule} berhasil dihapus!"
        );

}

    /**
     * Generate kode_rule berikutnya secara otomatis (R01, R02, R03, ...)
     * berdasarkan nomor terbesar yang sudah ada di basis_pengetahuan.
     */
    private function generateNextKodeRule(): string
    {
        $last = PenyakitGejala::selectRaw('MAX(CAST(SUBSTRING(kode_rule, 2) AS UNSIGNED)) as max_num')
            ->value('max_num');

        $nextNum = ($last ?? 0) + 1;

        return 'R' . str_pad($nextNum, 2, '0', STR_PAD_LEFT);
    }
}