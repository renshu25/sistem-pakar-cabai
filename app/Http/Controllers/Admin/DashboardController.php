<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Diagnosa, Gejala, Penyakit, User};

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'users'    => User::where('role', 'user')->count(),
            'penyakit' => Penyakit::count(),
            'gejala'   => Gejala::count(),
            'diagnosa' => Diagnosa::count(),
        ];

        $diagnosaPerPenyakit = Penyakit::withCount('diagnosa')
            ->orderBy('diagnosa_count', 'desc')->get();

        $riwayatTerbaru = Diagnosa::with(['user', 'penyakit'])
            ->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'diagnosaPerPenyakit', 'riwayatTerbaru'));
    }
}