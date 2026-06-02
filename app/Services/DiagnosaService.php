<?php

namespace App\Services;

use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Support\Facades\Auth;
use App\Models\PenyakitGejala;

class DiagnosaService
{
public function prosesDiagnosa(array $inputGejala): array
{
    $inputGejala = array_map('strtoupper', $inputGejala);

    $basisData = PenyakitGejala::with(['penyakit', 'gejala'])->get();
    $rules = [];
    $bobotRule = [];

    foreach ($basisData as $basis) {
        if (!$basis->penyakit || !$basis->gejala) continue;
        $kp = strtoupper($basis->penyakit->kode_penyakit);
        $kg = strtoupper($basis->gejala->kode_gejala);
        $rules[$kp][] = $kg;
        $bobotRule[$kp][$kg] = (float) $basis->bobot_gejala;
    }


        $hasil = [];

        /**
         * RULE BASED + WP
         */
        foreach ($rules as $kodePenyakit => $gejalaRule) {

            $gejalaRule = array_unique($gejalaRule);

            $jumlahCocok = count(
                array_intersect($inputGejala, $gejalaRule)
            );

            if ($jumlahCocok < 1) continue;

            $S = 1;

            foreach ($gejalaRule as $kodeGejala) {

                $kodeGejala = strtoupper($kodeGejala);

                $nilai = in_array($kodeGejala, $inputGejala) ? 1 : 0.1;

                $bobotNilai = $bobotRule[$kodePenyakit][$kodeGejala] ?? 0.1;

                $S *= pow($nilai, $bobotNilai);
            }

            $hasil[$kodePenyakit] = [
                'nilai_s' => $S,
                'cocok' => $jumlahCocok,
            ];
        }

        /**
         * JIKA TIDAK ADA HASIL
         */
        if (empty($hasil)) {

            $diagnosa = Diagnosa::create([
                'user_id' => Auth::id(),
                'penyakit_id' => null,
                'nama_user' => Auth::user()->name,
                'nilai_hasil' => 0,
                'keterangan' => 'Tidak Teridentifikasi',
            ]);

            return [
                'diagnosa' => $diagnosa->load(['penyakit.obat', 'gejala']),
                'ranking' => []
            ];
        }

        /**
         * TOTAL S
         */
        $totalS = array_sum(array_column($hasil, 'nilai_s'));

        if ($totalS == 0) $totalS = 1;

        /**
         * HITUNG V
         */
        foreach ($hasil as $kode => $item) {
            $hasil[$kode]['nilai_v'] = $item['nilai_s'] / $totalS;
        }

        /**
         * SORT RANKING
         */
        uasort($hasil, fn($a, $b) => $b['nilai_v'] <=> $a['nilai_v']);

        $kodePenyakitTerpilih = array_key_first($hasil);

        if (!$kodePenyakitTerpilih) {
            return [
                'diagnosa' => null,
                'ranking' => []
            ];
        }

        $nilaiAkhir = round($hasil[$kodePenyakitTerpilih]['nilai_v'], 4);

        $penyakit = Penyakit::where('kode_penyakit', $kodePenyakitTerpilih)->first();

        /**
         * SIMPAN DIAGNOSA
         */
        $diagnosa = Diagnosa::create([
            'user_id' => Auth::id(),
            'penyakit_id' => $penyakit?->id,
            'nama_user' => Auth::user()->name,
            'nilai_hasil' => $nilaiAkhir,
            'keterangan' => $this->getKeterangan($nilaiAkhir),
        ]);

        /**
         * SIMPAN GEJALA
         */
        foreach ($inputGejala as $kodeGejala) {

            $gejala = Gejala::where('kode_gejala', $kodeGejala)->first();

            if ($gejala) {
                $diagnosa->gejala()->attach($gejala->id, [
                    'nilai_user' => 1
                ]);
            }
        }

        /**
         * RANKING OUTPUT
         */
        $ranking = [];

        foreach ($hasil as $kode => $item) {

            $penyakitRank = Penyakit::where('kode_penyakit', $kode)->first();

            $ranking[$kode] = [
                'nama_penyakit' => $penyakitRank?->nama_penyakit,
                'nilai_v' => $item['nilai_v'],
            ];
        }

        return [
            'diagnosa' => $diagnosa->load(['penyakit.obat', 'gejala']),
            'ranking' => $ranking
        ];
    }

    /**
     * Keterangan hasil
     */
    private function getKeterangan($nilai): string
    {
        if ($nilai >= 0.8) return 'Sangat Tinggi';
        if ($nilai >= 0.6) return 'Kemungkinan Besar';
        if ($nilai >= 0.4) return 'Kemungkinan Sedang';

        return 'Kemungkinan Rendah';
    }
}