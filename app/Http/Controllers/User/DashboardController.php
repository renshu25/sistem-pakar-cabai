<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use App\Models\Penyakit;
use App\Models\Gejala;

class DashboardController extends Controller
{
public function index()
{
    $totalPenyakit = Penyakit::count();

    $totalGejala = Gejala::count();

    $riwayat = Diagnosa::with('penyakit')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();

    // Grafik jumlah diagnosa
    $chartData = $riwayat
        ->groupBy(function ($item) {
            return $item->penyakit->nama_penyakit ?? '-';
        })
        ->map(function ($item) {
            return $item->count();
        });

    // Grafik nilai WP
    $wpLabels = $riwayat->pluck('penyakit.nama_penyakit');

    $wpValues = $riwayat->map(function ($item) {
        return round($item->nilai_hasil * 100, 0);
    });

    return view('user.dashboard', compact(
        'totalPenyakit',
        'totalGejala',
        'riwayat',
        'chartData',
        'wpLabels',
        'wpValues'
    ));
}
}