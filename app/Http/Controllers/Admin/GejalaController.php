<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    // 1. TAMPILKAN SEMUA GEJALA
    public function index()
    {
        $allGejala = Gejala::orderBy('kode_gejala', 'asc')->get();
        return view('admin.gejala.index', compact('allGejala'));
    }

    // 2. SIMPAN GEJALA BARU
    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|unique:gejala,kode_gejala',
            'nama_gejala' => 'required|string|max:255',
            'bobot'       => 'required|numeric|between:0,1',
        ]);

        Gejala::create([
            'kode_gejala' => strtoupper($request->kode_gejala),
            'nama_gejala' => $request->nama_gejala,
            'bobot'       => $request->bobot,
        ]);

        return redirect()->back()->with('success', 'Gejala baru berhasil ditambahkan!');
    }

    // 3. UPDATE DATA GEJALA
    public function update(Request $request, $id)
    {
        $gejala = Gejala::findOrFail($id);

        $request->validate([
            'kode_gejala' => 'required|unique:gejala,kode_gejala,' . $id,
            'nama_gejala' => 'required|string|max:255',
            'bobot'       => 'required|numeric|between:0,1',
        ]);

        $gejala->update([
            'kode_gejala' => strtoupper($request->kode_gejala),
            'nama_gejala' => $request->nama_gejala,
            'bobot'       => $request->bobot,
        ]);

        return redirect()->back()->with('success', 'Data gejala berhasil diperbarui!');
    }

    // 4. HAPUS GEJALA
    public function destroy($id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();

        return redirect()->back()->with('success', 'Gejala berhasil dihapus dari sistem!');
    }
}