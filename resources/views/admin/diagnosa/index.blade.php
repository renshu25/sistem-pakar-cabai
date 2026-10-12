@extends('layouts.admin')
@section('title', 'Riwayat Diagnosa')
@section('page-title', 'Monitoring Diagnosa Petani')

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

    .db-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.25rem; flex-wrap: wrap; gap: 1rem; }
    .db-header-left h1 { font-size: 1.625rem; font-weight: 800; color: var(--slate-900); letter-spacing: -.4px; margin: 0 0 .2rem; }
    .db-header-left p  { font-size: .825rem; color: var(--slate-400); margin: 0; font-weight: 500; }

    .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 1rem; margin-bottom: 1.75rem; }
    .stat-card { background: var(--white); border: 1px solid var(--slate-200); border-radius: var(--radius); padding: 1.25rem 1.5rem; box-shadow: var(--shadow-sm); }
    .stat-label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: var(--slate-400); margin-bottom: .4rem; }
    .stat-value { font-size: 1.75rem; font-weight: 800; color: var(--slate-900); line-height: 1; }
    .stat-sub   { font-size: .75rem; color: var(--slate-400); margin-top: .3rem; }

    .filter-bar { background: var(--white); border: 1px solid var(--slate-200); border-radius: var(--radius); padding: 1.25rem 1.5rem; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm); }
    .filter-row { display: flex; gap: .75rem; flex-wrap: wrap; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; gap: .35rem; flex: 1; min-width: 180px; }
    .filter-group label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: var(--slate-500); }
    .form-control { width: 100%; padding: .6rem .85rem; font-size: .875rem; border: 1px solid var(--slate-200); border-radius: var(--radius-sm); background: var(--white); color: var(--slate-800); outline: none; font-family: inherit; }
    .form-control:focus { border-color: var(--blue-500); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }
    .btn-primary   { display: inline-flex; align-items: center; gap: .5rem; font-size: .85rem; font-weight: 600; color: var(--white); background: var(--blue-600); border: 1px solid var(--blue-600); border-radius: var(--radius-sm); padding: .62rem 1.2rem; text-decoration: none; cursor: pointer; transition: all var(--transition); font-family: inherit; }
    .btn-primary:hover { background: var(--blue-700); border-color: var(--blue-700); }
    .btn-secondary { display: inline-flex; align-items: center; gap: .5rem; font-size: .85rem; font-weight: 600; color: var(--slate-600); background: var(--white); border: 1px solid var(--slate-200); border-radius: var(--radius-sm); padding: .62rem 1.2rem; text-decoration: none; cursor: pointer; transition: all var(--transition); font-family: inherit; }
    .btn-secondary:hover { background: var(--slate-50); }

    .main-card          { background: var(--white); border-radius: var(--radius); border: 1px solid var(--slate-200); box-shadow: var(--shadow-sm); overflow: hidden; }
    .table-responsive   { width: 100%; overflow-x: auto; }
    .h-table            { width: 100%; border-collapse: collapse; font-size: .86rem; }
    .h-table thead th   { background: var(--slate-50); color: var(--slate-400); font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .65px; padding: .9rem 1.5rem; text-align: left; border-bottom: 1px solid var(--slate-100); }
    .h-table tbody tr   { border-bottom: 1px solid var(--slate-100); transition: background var(--transition); }
    .h-table tbody tr:hover { background: var(--slate-50); }
    .h-table td         { padding: 1rem 1.5rem; color: var(--slate-700); vertical-align: middle; line-height: 1.5; }

    .td-no       { font-weight: 700; color: var(--slate-400); font-size: .8rem; }
    .td-name     { font-weight: 700; color: var(--slate-800); font-size: .9rem; }
    .td-sub      { font-size: .775rem; color: var(--slate-400); margin-top: .1rem; }
    .td-penyakit { font-weight: 600; color: var(--slate-700); }

    .badge-nilai { display: inline-block; padding: .25rem .65rem; border-radius: 999px; font-size: .75rem; font-weight: 700; background: var(--emerald-50); color: var(--emerald-600); border: 1px solid var(--emerald-100); }

    .btn-detail { display: inline-flex; align-items: center; gap: .35rem; font-size: .78rem; font-weight: 600; color: var(--blue-600); background: var(--blue-50); border: 1px solid var(--blue-100); border-radius: 8px; padding: .35rem .75rem; text-decoration: none; transition: all var(--transition); }
    .btn-detail:hover { background: var(--blue-600); color: var(--white); border-color: var(--blue-600); }

    .pagination-wrap  { padding: 1.25rem 1.5rem; border-top: 1px solid var(--slate-100); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
    .pagination-info  { font-size: .8rem; color: var(--slate-400); }
    .pagination-links { display: flex; gap: .35rem; }
    .page-btn         { width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: .82rem; font-weight: 600; text-decoration: none; border: 1px solid var(--slate-200); color: var(--slate-600); background: var(--white); transition: all var(--transition); }
    .page-btn:hover   { border-color: var(--blue-500); color: var(--blue-600); }
    .page-btn.active  { background: var(--blue-600); color: var(--white); border-color: var(--blue-600); }
    .page-btn.disabled { opacity: .4; pointer-events: none; }

    .empty-state     { text-align: center; padding: 4rem 2rem; }
    .empty-state svg { opacity: .25; margin-bottom: 1rem; }
    .empty-state p   { color: var(--slate-400); font-size: .9rem; }
</style>

<div class="db-wrap">

    {{-- HEADER --}}
    <div class="db-header">
        <div class="db-header-left">
            <h1>Riwayat Diagnosa</h1>
            <p>Monitoring seluruh diagnosa yang dilakukan petani</p>
        </div>
    </div>

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-label">Total Diagnosa</div>
            <div class="stat-value">{{ $diagnosa->total() }}</div>
            <div class="stat-sub">semua periode</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Bulan Ini</div>
            <div class="stat-value">{{ \App\Models\Diagnosa::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count() }}</div>
            <div class="stat-sub">{{ now()->translatedFormat('F Y') }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Petani Aktif</div>
            <div class="stat-value">{{ \App\Models\Diagnosa::distinct('user_id')->count('user_id') }}</div>
            <div class="stat-sub">pernah diagnosa</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Penyakit Terbanyak</div>
            @php
                $top = \App\Models\Diagnosa::select('penyakit_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                    ->with('penyakit')
                    ->groupBy('penyakit_id')
                    ->orderByDesc('total')
                    ->first();
            @endphp
            <div class="stat-value" style="font-size:1rem; padding-top:.25rem;">
                {{ $top?->penyakit?->nama_penyakit ?? '-' }}
            </div>
            <div class="stat-sub">{{ $top ? $top->total . ' kasus' : '' }}</div>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="filter-bar">
        <form method="GET" action="{{ route('admin.diagnosa.index') }}">
            <div class="filter-row">
                <div class="filter-group" style="flex:2;">
                    <label>Cari Petani / Penyakit</label>
                    <input type="text" name="search" class="form-control" placeholder="Ketik nama petani atau penyakit..." value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label>Filter Penyakit</label>
                    <select name="penyakit_id" class="form-control">
                        <option value="">Semua Penyakit</option>
                        @foreach($penyakit as $p)
                            <option value="{{ $p->id }}" {{ request('penyakit_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="display:flex; gap:.5rem; align-items:flex-end;">
                    <button type="submit" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                        Cari
                    </button>
                    @if(request()->anyFilled(['search', 'penyakit_id']))
                        <a href="{{ route('admin.diagnosa.index') }}" class="btn-secondary">Reset</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="main-card">
        <div class="table-responsive">
            <table class="h-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Petani</th>
                        <th>Hasil Diagnosa</th>
                        <th style="width:120px;">Nilai WP</th>
                        <th style="width:150px;">Tanggal</th>
                        <th style="width:90px; text-align:center;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($diagnosa as $index => $d)
                        <tr>
                            <td class="td-no">{{ $diagnosa->firstItem() + $index }}</td>
                            <td>
                                <div class="td-name">{{ $d->nama_user ?? $d->user?->name ?? '-' }}</div>
                                <div class="td-sub">{{ $d->user?->email ?? '' }}</div>
                            </td>
                            <td>
                                <div class="td-penyakit">{{ $d->penyakit?->nama_penyakit ?? '-' }}</div>
                                <div class="td-sub">{{ $d->penyakit?->kode_penyakit ?? '' }}</div>
                            </td>
                            <td>
                                <span class="badge-nilai">{{ number_format($d->nilai_hasil, 4) }}</span>
                            </td>
                            <td style="color:var(--slate-500); font-size:.82rem;">
                                {{ $d->created_at->format('d M Y') }}<br>
                                <span style="color:var(--slate-400);">{{ $d->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ route('admin.diagnosa.show', $d->id) }}" class="btn-detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p>Belum ada riwayat diagnosa.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($diagnosa->hasPages())
        <div class="pagination-wrap">
            <div class="pagination-info">
                Menampilkan {{ $diagnosa->firstItem() }}–{{ $diagnosa->lastItem() }} dari {{ $diagnosa->total() }} data
            </div>
            <div class="pagination-links">
                @if($diagnosa->onFirstPage())
                    <span class="page-btn disabled">‹</span>
                @else
                    <a href="{{ $diagnosa->previousPageUrl() }}" class="page-btn">‹</a>
                @endif

                @foreach($diagnosa->getUrlRange(1, $diagnosa->lastPage()) as $page => $url)
                    @if($page == $diagnosa->currentPage())
                        <span class="page-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @endif
                @endforeach

                @if($diagnosa->hasMorePages())
                    <a href="{{ $diagnosa->nextPageUrl() }}" class="page-btn">›</a>
                @else
                    <span class="page-btn disabled">›</span>
                @endif
            </div>
        </div>
        @endif
    </div>

</div>
@endsection