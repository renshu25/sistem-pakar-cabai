<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Menampilkan halaman utama manajemen penyakit (Tabel & Modal jadi satu)
     */
    public function index() {
        // withCount('gejala') tetap dipertahankan jika nanti ingin menampilkan jumlah gejala di tabel
        $penyakit = Penyakit::withCount('gejala')->paginate(15);
        return view('admin.penyakit.index', compact('penyakit'));
    }

    /**
     * Menyimpan data penyakit baru dari modal
     */
// --- PROSES TAMBAH DATA (STORE) ---
public function store(Request $request)
{
    $request->validate([
        'kode_penyakit' => 'required|unique:penyakit,kode_penyakit',
        'nama_penyakit' => 'required|string|max:255',
        'deskripsi'     => 'nullable|string',
    ]);

    Penyakit::create([
        'kode_penyakit' => $request->kode_penyakit,
        'nama_penyakit' => $request->nama_penyakit,
        'deskripsi'     => $request->deskripsi, // Dikirim ke kolom deskripsi
    ]);

    return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil ditambahkan.');
}

// --- PROSES EDIT DATA (UPDATE) ---
public function update(Request $request, Penyakit $penyakit)
{
    $request->validate([
        'kode_penyakit' => 'required|unique:penyakit,kode_penyakit,' . $penyakit->id,
        'nama_penyakit' => 'required|string|max:255',
        'deskripsi'     => 'nullable|string',
    ]);

    $penyakit->update([
        'kode_penyakit' => $request->kode_penyakit,
        'nama_penyakit' => $request->nama_penyakit,
        'deskripsi'     => $request->deskripsi, // Diperbarui ke kolom deskripsi
    ]);

    return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil diperbarui.');
}

    /**
     * Menghapus data penyakit
     */
    public function destroy(Penyakit $penyakit) {
        $penyakit->delete();
        return back()->with('success', 'Penyakit berhasil dihapus.');
    }
}