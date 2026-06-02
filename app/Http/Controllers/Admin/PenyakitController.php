<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Penyakit, Obat};
use Illuminate\Http\Request;

class PenyakitController extends Controller {
    public function index() {
        $penyakit = Penyakit::withCount('gejala')->paginate(15);
        return view('admin.penyakit.index', compact('penyakit'));
    }
    public function create() {
        $obat = Obat::all();
        return view('admin.penyakit.form', compact('obat'));
    }
    public function store(Request $request) {
        $request->validate([
            'kode_penyakit'  => 'required|unique:penyakit',
            'nama_penyakit'  => 'required',
            'deskripsi'      => 'nullable',
        ]);
        $p = Penyakit::create($request->only('kode_penyakit', 'nama_penyakit', 'deskripsi'));
        if ($request->obat_ids) $p->obat()->sync($request->obat_ids);
        return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil ditambahkan.');
    }
    public function edit(Penyakit $penyakit) {
        $obat = Obat::all();
        return view('admin.penyakit.form', compact('penyakit', 'obat'));
    }
    public function update(Request $request, Penyakit $penyakit) {
        $request->validate(['kode_penyakit' => 'required|unique:penyakit,kode_penyakit,'.$penyakit->id, 'nama_penyakit' => 'required']);
        $penyakit->update($request->only('kode_penyakit', 'nama_penyakit', 'deskripsi'));
        if ($request->has('obat_ids')) $penyakit->obat()->sync($request->obat_ids ?? []);
        return redirect()->route('admin.penyakit.index')->with('success', 'Penyakit berhasil diperbarui.');
    }
    public function destroy(Penyakit $penyakit) {
        $penyakit->delete();
        return back()->with('success', 'Penyakit dihapus.');
    }
}