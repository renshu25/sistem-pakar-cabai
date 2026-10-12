<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profil'); // ✅ diperbaiki: 'profil' bukan 'profile'
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min'      => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->withErrors([
                'password_lama' => 'Password lama tidak sesuai.'
            ]);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return redirect()
            ->route('user.profil')
            ->with('success', 'Password berhasil diperbarui.');
    }
}