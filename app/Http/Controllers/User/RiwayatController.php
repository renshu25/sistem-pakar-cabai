<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Diagnosa;
use App\Models\DiagnosaGejala;

class RiwayatController extends Controller
{
    public function hapusSemua(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        DB::transaction(function () use ($request) {

            DiagnosaGejala::whereIn('diagnosa_id', $request->ids)->delete();

            Diagnosa::where('user_id', Auth::id())
                ->whereIn('id', $request->ids)
                ->delete();

        });

        return back()->with('success', 'Riwayat diagnosa berhasil dihapus.');
    }
}