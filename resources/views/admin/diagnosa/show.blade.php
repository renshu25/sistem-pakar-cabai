@extends('layouts.admin')
@section('title', 'Detail Diagnosa')
@section('page-title', 'Detail Hasil Diagnosa')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<style>
    :root {
        --blue-50:     #eff6ff;
        --blue-100:    #dbeafe;
        --blue-500:    #3b82f6;
        --blue-600:    #2563eb;
        --blue-700:    #1d4ed8;
        --emerald-50:  #ecfdf5;
        --emerald-100: #d1fae5;
        --emerald-500: #10b981;
        --emerald-600: #059669;
        --amber-50:    #fffbeb;
        --amber-100:   #fef3c7;
        --amber-500:   #f59e0b;
        --amber-600:   #d97706;
        --rose-50:     #fff1f2;
        --rose-500:    #f43f5e;
        --slate-50:    #f8fafc;
        --slate-100:   #f1f5f9;
        --slate-200:   #e2e8f0;
        --slate-300:   #cbd5e1;
        --slate-400:   #94a3b8;
        --slate-500:   #64748b;
        --slate-600:   #475569;
        --slate-700:   #334155;
        --slate-800:   #1e293b;
        --slate-900:   #0f172a;
        --white:       #ffffff;
        --radius-sm:   10px;
        --radius:      16px;
        --radius-lg:   20px;
        --shadow-sm:   0 1px 2px rgba(15,23,42,.04), 0 2px 8px rgba(15,23,42,.06);
        --shadow:      0 2px 4px rgba(15,23,42,.04), 0 8px 24px rgba(15,23,42,.07);
        --shadow-md:   0 4px 8px rgba(15,23,42,.06), 0 16px 40px rgba(15,23,42,.10);
        --transition:  .22s cubic-bezier(.4,0,.2,1);
    }

    .db-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
    .db-wrap   { background: var(--slate-100); min-height: 100vh; padding: 2.25rem 2rem 4rem; }

    /* ── BACK LINK ── */
    .back-link { display: inline-flex; align-items: center; gap: .4rem; font-size: .82rem; font-weight: 600; color: var(--slate-500); text-decoration: none; margin-bottom: 1.5rem; transition: color var(--transition); }
    .back-link:hover { color: var(--blue-600); }

    /* ── LAYOUT ── */
    .detail-grid { display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start; }
    @media (max-width: 900px) { .detail-grid { grid-template-columns: 1fr; } }

    /* ── CARDS ── */
    .card { background: var(--white); border: 1px solid var(--slate-200); border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden; margin-bottom: 1.5rem; }
    .card-header { padding: 1.1rem 1.5rem; border-bottom: 1px solid var(--slate-100); display: flex; align-items: center; gap: .65rem; }
    .card-header h2 { font-size: .95rem; font-weight: 700; color: var(--slate-800); margin: 0; }
    .card-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .card-body { padding: 1.5rem; }

    /* ── INFO ROWS ── */
    .info-row { display: flex; gap: 1rem; padding: .75rem 0; border-bottom: 1px solid var(--slate-100); align-items: flex-start; }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-label { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: var(--slate-400); width: 140px; flex-shrink: 0; padding-top: .1rem; }
    .info-value { font-size: .875rem; color: var(--slate-700); font-weight: 500; flex: 1; }
    .info-value strong { color: var(--slate-900); font-weight: 700; }

    /* ── RESULT BANNER ── */
    .result-banner { background: linear-gradient(135deg, var(--emerald-50) 0%, #f0fdf4 100%); border: 1px solid var(--emerald-100); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1.25rem; }
    .result-icon { width: 52px; height: 52px; border-radius: 14px; background: var(--emerald-500); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .result-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: var(--emerald-600); margin-bottom: .2rem; }
    .result-name  { font-size: 1.3rem; font-weight: 800; color: var(--slate-900); line-height: 1.2; }
    .result-kode  { font-size: .78rem; color: var(--slate-400); margin-top: .2rem; }

    .nilai-chip { display: inline-flex; align-items: center; gap: .4rem; background: var(--blue-50); border: 1px solid var(--blue-100); color: var(--blue-600); font-size: .8rem; font-weight: 700; border-radius: 999px; padding: .3rem .85rem; }

    /* ── GEJALA TABLE ── */
    .h-table { width: 100%; border-collapse: collapse; font-size: .85rem; }
    .h-table thead th { background: var(--slate-50); color: var(--slate-400); font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .65px; padding: .75rem 1.25rem; text-align: left; border-bottom: 1px solid var(--slate-100); }
    .h-table tbody tr { border-bottom: 1px solid var(--slate-100); }
    .h-table tbody tr:last-child { border-bottom: none; }
    .h-table tbody tr:hover { background: var(--slate-50); }
    .h-table td { padding: .9rem 1.25rem; color: var(--slate-700); vertical-align: middle; }

    .td-kode { font-weight: 700; color: var(--blue-600); background: var(--blue-50); padding: .2rem .5rem; border-radius: 6px; font-size: .76rem; }
    .td-gejala { font-weight: 500; color: var(--slate-700); }
    .bobot-pill { display: inline-block; padding: .2rem .55rem; border-radius: 999px; font-size: .73rem; font-weight: 700; background: var(--amber-50); color: var(--amber-600); border: 1px solid var(--amber-100); }

    /* ── OBAT LIST ── */
    .obat-item { display: flex; align-items: flex-start; gap: .75rem; padding: .85rem 0; border-bottom: 1px solid var(--slate-100); }
    .obat-item:last-child { border-bottom: none; }
    .obat-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--emerald-500); flex-shrink: 0; margin-top: .35rem; }
    .obat-name { font-weight: 600; color: var(--slate-800); font-size: .875rem; }
    .obat-desc { font-size: .78rem; color: var(--slate-400); margin-top: .15rem; }

    /* ── META CARD ── */
    .meta-item { display: flex; justify-content: space-between; align-items: center; padding: .7rem 0; border-bottom: 1px solid var(--slate-100); font-size: .83rem; }
    .meta-item:last-child { border-bottom: none; }
    .meta-key { color: var(--slate-400); font-weight: 500; }
    .meta-val { color: var(--slate-700); font-weight: 600; }

    .btn-back { display: inline-flex; align-items: center; gap: .5rem; font-size: .85rem; font-weight: 600; color: var(--slate-600); background: var(--white); border: 1px solid var(--slate-200); border-radius: var(--radius-sm); padding: .62rem 1.2rem; text-decoration: none; cursor: pointer; transition: all var(--transition); }
    .btn-back:hover { background: var(--slate-50); }
</style>

<div class="db-wrap">

    <a href="{{ route('admin.diagnosa.index') }}" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Riwayat Diagnosa
    </a>

    {{-- ── HASIL BANNER ── --}}
    <div class="result-banner">
        <div class="result-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div style="flex:1;">
            <div class="result-label">Hasil Diagnosa</div>
            <div class="result-name">{{ $diagnosa->penyakit?->nama_penyakit ?? 'Tidak teridentifikasi' }}</div>
            <div class="result-kode">{{ $diagnosa->penyakit?->kode_penyakit ?? '' }}</div>
        </div>
        <div class="nilai-chip">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Nilai WP: {{ number_format($diagnosa->nilai_hasil, 4) }}
        </div>
    </div>

    <div class="detail-grid">

        {{-- ── KOLOM KIRI ── --}}
        <div>

            {{-- INFO PETANI --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--blue-50);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="var(--blue-600)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h2>Informasi Petani</h2>
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value"><strong>{{ $diagnosa->nama_user ?? $diagnosa->user?->name ?? '-' }}</strong></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $diagnosa->user?->email ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal Diagnosa</span>
                        <span class="info-value">{{ $diagnosa->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>
                    @if($diagnosa->keterangan)
                    <div class="info-row">
                        <span class="info-label">Keterangan</span>
                        <span class="info-value">{{ $diagnosa->keterangan }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- GEJALA YANG DIPILIH --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--amber-50);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="var(--amber-600)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h2>Gejala yang Dipilih <span style="color:var(--slate-400); font-weight:400; font-size:.82rem;">({{ $diagnosa->gejala->count() }} gejala)</span></h2>
                </div>
                <table class="h-table">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th style="width:90px;">Kode</th>
                            <th>Nama Gejala</th>
                            <th style="width:90px; text-align:center;">Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($diagnosa->gejala as $i => $g)
                            <tr>
                                <td style="color:var(--slate-400); font-size:.78rem; font-weight:700;">{{ $i + 1 }}</td>
                                <td><span class="td-kode">{{ $g->kode_gejala }}</span></td>
                                <td class="td-gejala">{{ $g->nama_gejala }}</td>
                                <td style="text-align:center;">
                                    <span class="bobot-pill">{{ $g->pivot->nilai_user ?? '-' }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; color:var(--slate-400); padding:2rem 0; font-size:.85rem;">
                                    Tidak ada data gejala tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- DESKRIPSI PENYAKIT --}}
            @if($diagnosa->penyakit?->deskripsi)
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--rose-50);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="var(--rose-500)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2>Tentang Penyakit</h2>
                </div>
                <div class="card-body">
                    <p style="font-size:.875rem; color:var(--slate-600); line-height:1.7; margin:0;">
                        {{ $diagnosa->penyakit->deskripsi }}
                    </p>
                </div>
            </div>
            @endif

        </div>

        {{-- ── KOLOM KANAN ── --}}
        <div>

            {{-- META INFO --}}
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--slate-100);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="var(--slate-500)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2>Ringkasan</h2>
                </div>
                <div class="card-body">
                    <div class="meta-item">
                        <span class="meta-key">ID Diagnosa</span>
                        <span class="meta-val">#{{ $diagnosa->id }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-key">Metode</span>
                        <span class="meta-val">Rule-Based + WP</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-key">Nilai Akhir WP</span>
                        <span class="meta-val" style="color:var(--blue-600);">{{ number_format($diagnosa->nilai_hasil, 6) }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-key">Jumlah Gejala</span>
                        <span class="meta-val">{{ $diagnosa->gejala->count() }} gejala</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-key">Tanggal</span>
                        <span class="meta-val">{{ $diagnosa->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            {{-- REKOMENDASI OBAT --}}
            @if($diagnosa->penyakit?->obat?->count())
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: var(--emerald-50);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="var(--emerald-600)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <h2>Rekomendasi Penanganan</h2>
                </div>
                <div class="card-body">
@foreach($diagnosa->penyakit->obat as $obat)
    <div class="obat-item">
        <div class="obat-dot"></div>
        <div>
            <div class="obat-name">{{ $obat->nama_obat }}</div>
            @if($obat->keterangan)          {{-- ← ganti di sini --}}
                <div class="obat-desc">{{ $obat->keterangan }}</div>  {{-- ← dan sini --}}
            @endif
        </div>
    </div>
@endforeach
                </div>
            </div>
            @endif

            {{-- TOMBOL KEMBALI --}}
            <a href="{{ route('admin.diagnosa.index') }}" class="btn-back" style="width:100%; justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Daftar
            </a>

        </div>
    </div>

</div>
@endsection