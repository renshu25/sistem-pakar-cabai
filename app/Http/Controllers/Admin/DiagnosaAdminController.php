<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use Illuminate\Http\Request;

class DiagnosaAdminController extends Controller
{
    /**
     * Halaman daftar semua riwayat diagnosa (semua petani)
     */
    public function index(Request $request)
    {
        $query = Diagnosa::with(['user', 'penyakit'])
            ->latest();

        // Filter pencarian nama user atau nama penyakit
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_user', 'like', "%{$search}%")
                  ->orWhereHas('penyakit', function ($q2) use ($search) {
                      $q2->where('nama_penyakit', 'like', "%{$search}%");
                  });
            });
        }

        // Filter berdasarkan penyakit
        if ($request->filled('penyakit_id')) {
            $query->where('penyakit_id', $request->penyakit_id);
        }

        $diagnosa  = $query->paginate(10)->withQueryString();
        $penyakit  = \App\Models\Penyakit::orderBy('nama_penyakit')->get();

        return view('admin.diagnosa.index', compact('diagnosa', 'penyakit'));
    }

    /**
     * Halaman detail satu diagnosa
     */
    public function show($id)
    {
        $diagnosa = Diagnosa::with([
            'user',
            'penyakit.obat',
            'gejala',
        ])->findOrFail($id);

        return view('admin.diagnosa.show', compact('diagnosa'));
    }
}