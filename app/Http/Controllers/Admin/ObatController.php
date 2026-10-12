<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA OBAT
    public function index()
    {
        $allObat = Obat::orderBy('id', 'desc')->get();
        return view('admin.obat.index', compact('allObat'));
    }

    // 2. SIMPAN OBAT BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Obat baru berhasil ditambahkan!');
    }

    // 3. UPDATE DATA OBAT
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data obat berhasil diperbarui!');
    }

    // 4. HAPUS DATA OBAT
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);

        // Memutuskan hubungan relasi di tabel pivot penyakit_obat terlebih dahulu agar tidak error foreign key
        $obat->penyakit()->detach();

        $obat->delete();

        return redirect()->back()->with('success', 'Obat berhasil dihapus dari sistem!');
    }
}