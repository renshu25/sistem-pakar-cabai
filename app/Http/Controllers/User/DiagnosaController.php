<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Services\DiagnosaService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosaController extends Controller
{
    public function __construct(private DiagnosaService $service)
    {
    }

    /**
     * Halaman pilih gejala
     */
public function index()
{
    // Mengambil semua master gejala untuk dicentang user
    $gejalaData = \App\Models\Gejala::orderBy('kode_gejala', 'asc')->get();

    return view('user.diagnosa.index', compact('gejalaData'));
}
    /**
     * Proses diagnosa (Rule-Based + Weighted Product)
     */
public function proses(Request $request)
{
    $inputGejala = $request->gejala ?? [];

    if (empty($inputGejala)) {
        return back()->with('error', 'Pilih minimal 1 gejala.');
    }


    // hapus data session ranking lama
    session()->forget('ranking');


    $hasil = $this->service->prosesDiagnosa($inputGejala);


    if($hasil['diagnosa'] == null){

        return back()->with(
            'error',
            $hasil['pesan']
        );

    }


    $diagnosa = $hasil['diagnosa'];


    // simpan ranking hasil baru
    session()->put(
        'ranking',
        $hasil['ranking']
    );


    return redirect()->route(
        'user.diagnosa.hasil',
        $diagnosa->id
    );
}

    /**
     * Hasil diagnosa
     */
    public function hasil($id)
{
    $diagnosa = Diagnosa::with([
        'penyakit.obat',
        'gejala'
    ])->findOrFail($id);


    $ranking = session('ranking', []);


    return view('user.diagnosa.hasil', compact(
        'diagnosa',
        'ranking'
    ));
}

    /**
     * Riwayat diagnosa user
     */
    public function riwayat()
    {
        $riwayat = Diagnosa::with('penyakit')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.riwayat', compact('riwayat'));
    }

    /**
     * Hapus riwayat diagnosa
     */
    public function hapusRiwayat($id)
    {
        $diagnosa = Diagnosa::where('user_id', auth()->id())
            ->findOrFail($id);

        // hapus relasi pivot gejala
        $diagnosa->gejala()->detach();

        // hapus data diagnosa
        $diagnosa->delete();

        return redirect()
            ->route('user.riwayat')
            ->with('success', 'Riwayat berhasil dihapus.');
    }

    /**
     * Export PDF hasil diagnosa
     */
    public function exportPdf($id)
    {
        $diagnosa = Diagnosa::with([
            'penyakit.obat',
            'gejala',
            'user'
        ])->findOrFail($id);

        // keamanan akses user
        if ($diagnosa->user_id !== auth()->id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('user.diagnosa.pdf', compact('diagnosa'));

        return $pdf->download("diagnosa-{$diagnosa->id}.pdf");
    }
}