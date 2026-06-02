@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<style>
    /* ─────────────────────────────────────────
       DESIGN TOKENS  (sama persis dengan user dashboard)
    ───────────────────────────────────────── */
    :root {
        --blue-50:   #eff6ff;
        --blue-100:  #dbeafe;
        --blue-500:  #3b82f6;
        --blue-600:  #2563eb;
        --blue-700:  #1d4ed8;

        --emerald-50:  #ecfdf5;
        --emerald-500: #10b981;
        --emerald-600: #059669;

        --amber-50:  #fffbeb;
        --amber-500: #f59e0b;
        --amber-600: #d97706;

        --rose-50:  #fff1f2;
        --rose-500: #f43f5e;
        --rose-600: #e11d48;

        --violet-50:  #f5f3ff;
        --violet-500: #8b5cf6;
        --violet-600: #7c3aed;

        --slate-50:  #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --slate-900: #0f172a;

        --white: #ffffff;
        --radius-sm: 10px;
        --radius:    16px;
        --radius-lg: 20px;
        --shadow-sm: 0 1px 2px rgba(15,23,42,.04), 0 2px 8px rgba(15,23,42,.06);
        --shadow:    0 2px 4px rgba(15,23,42,.04), 0 8px 24px rgba(15,23,42,.07);
        --shadow-md: 0 4px 8px rgba(15,23,42,.06), 0 16px 40px rgba(15,23,42,.10);
        --transition: .22s cubic-bezier(.4,0,.2,1);
    }

    *, *::before, *::after { box-sizing: border-box; }

    body,
    .db-wrap * {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ─────────────────────────────────────────
       WRAPPER
    ───────────────────────────────────────── */
    .db-wrap {
        background: var(--slate-100);
        min-height: 100vh;
        padding: 2.25rem 2rem 4rem;
    }

    /* ─────────────────────────────────────────
       PAGE HEADER
    ───────────────────────────────────────── */
    .db-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2.25rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .db-header-left h1 {
        font-size: 1.625rem;
        font-weight: 800;
        color: var(--slate-900);
        letter-spacing: -.4px;
        margin: 0 0 .2rem;
    }

    .db-header-left p {
        font-size: .825rem;
        color: var(--slate-400);
        margin: 0;
        font-weight: 500;
    }

    .db-date-pill {
        display: flex;
        align-items: center;
        gap: .5rem;
        font-size: .78rem;
        font-weight: 600;
        color: var(--slate-500);
        background: var(--white);
        border: 1px solid var(--slate-200);
        border-radius: 999px;
        padding: .45rem 1rem;
        box-shadow: var(--shadow-sm);
    }

    .db-date-pill::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--emerald-500);
        flex-shrink: 0;
        animation: pulse-dot 2s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: .5; transform: scale(.8); }
    }

    /* ─────────────────────────────────────────
       STAT CARDS  (4 cards)
    ───────────────────────────────────────── */
    .stat-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.1rem;
        margin-bottom: 1.75rem;
    }

    @media (max-width: 1024px) { .stat-row { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 560px)  { .stat-row { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 1.5rem 1.6rem;
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: flex-start;
        gap: 1.1rem;
        transition: transform var(--transition), box-shadow var(--transition);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        inset: 0 0 auto 0;
        height: 3px;
        border-radius: var(--radius) var(--radius) 0 0;
    }

    .stat-card.s-green::after  { background: var(--emerald-500); }
    .stat-card.s-blue::after   { background: var(--blue-500); }
    .stat-card.s-amber::after  { background: var(--amber-500); }
    .stat-card.s-rose::after   { background: var(--rose-500); }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .s-green .stat-icon  { background: var(--emerald-50); color: var(--emerald-600); }
    .s-blue  .stat-icon  { background: var(--blue-50);    color: var(--blue-600); }
    .s-amber .stat-icon  { background: var(--amber-50);   color: var(--amber-600); }
    .s-rose  .stat-icon  { background: var(--rose-50);    color: var(--rose-600); }

    .stat-info { flex: 1; min-width: 0; }

    .stat-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
        color: var(--slate-400);
        margin-bottom: .35rem;
    }

    .stat-num {
        font-size: 2.1rem;
        font-weight: 800;
        color: var(--slate-900);
        line-height: 1;
        letter-spacing: -1px;
        margin-bottom: .3rem;
    }

    .stat-desc {
        font-size: .75rem;
        color: var(--slate-400);
        font-weight: 500;
    }

    /* ─────────────────────────────────────────
       MIDDLE GRID  (chart + top penyakit)
    ───────────────────────────────────────── */
    .mid-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) 320px;
        gap: 1.1rem;
        margin-bottom: 1.75rem;
        align-items: stretch;
    }

    @media (max-width: 1024px) { .mid-grid { grid-template-columns: 1fr; } }

    /* Chart card */
    .chart-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 1.6rem 1.75rem;
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
        min-height: 360px;
    }

    .card-title {
        font-size: .9rem;
        font-weight: 700;
        color: var(--slate-800);
        margin: 0 0 1.25rem;
        letter-spacing: -.1px;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .card-title .ct-icon {
        width: 28px; height: 28px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: .9rem;
    }

    .ct-icon.blue   { background: var(--blue-50);    color: var(--blue-600); }
    .ct-icon.green  { background: var(--emerald-50); color: var(--emerald-600); }
    .ct-icon.amber  { background: var(--amber-50);   color: var(--amber-600); }

    /* Top penyakit card */
    .top-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 1.6rem 1.75rem;
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
    }

    .top-item {
        display: flex;
        align-items: center;
        gap: .9rem;
        padding: .75rem 0;
        border-bottom: 1px solid var(--slate-100);
        transition: background var(--transition);
    }

    .top-item:last-child { border-bottom: none; }

    .top-rank {
        width: 26px; height: 26px;
        border-radius: 8px;
        background: var(--slate-100);
        color: var(--slate-500);
        font-size: .72rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .top-rank.r1 { background: var(--amber-50);   color: var(--amber-600); }
    .top-rank.r2 { background: var(--slate-100);   color: var(--slate-600); }
    .top-rank.r3 { background: var(--rose-50);     color: var(--rose-500); }

    .top-name {
        flex: 1;
        font-size: .85rem;
        font-weight: 600;
        color: var(--slate-700);
        min-width: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .top-badge {
        font-size: .75rem;
        font-weight: 700;
        padding: .25rem .7rem;
        border-radius: 999px;
        background: var(--blue-50);
        color: var(--blue-600);
        flex-shrink: 0;
    }

    /* Progress bar per item */
    .top-bar {
        height: 3px;
        background: var(--slate-100);
        border-radius: 999px;
        overflow: hidden;
        margin-top: .4rem;
    }

    .top-bar-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--blue-500), var(--blue-400));
    }

    /* ─────────────────────────────────────────
       TABLE CARD
    ───────────────────────────────────────── */
    .history-wrap {
        background: var(--white);
        border-radius: var(--radius);
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .history-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.4rem 1.75rem;
        border-bottom: 1px solid var(--slate-100);
    }

    .hh-left {
        display: flex; align-items: center; gap: .6rem;
    }

    .hh-left h2 {
        font-size: .9rem;
        font-weight: 700;
        color: var(--slate-800);
        margin: 0;
    }

    .hh-count {
        font-size: .72rem;
        font-weight: 700;
        color: var(--slate-400);
        background: var(--slate-100);
        border-radius: 999px;
        padding: .2rem .65rem;
    }

    .btn-lihat {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .78rem;
        font-weight: 600;
        color: var(--blue-600);
        background: var(--blue-50);
        border: 1px solid var(--blue-100);
        border-radius: 8px;
        padding: .4rem .9rem;
        text-decoration: none;
        transition: all var(--transition);
    }

    .btn-lihat:hover {
        background: var(--blue-600);
        color: var(--white);
        border-color: var(--blue-600);
    }

    /* Table */
    .h-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .86rem;
    }

    .h-table thead th {
        background: var(--slate-50);
        color: var(--slate-400);
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .65px;
        padding: .75rem 1.75rem;
        text-align: left;
        border-bottom: 1px solid var(--slate-100);
    }

    .h-table tbody tr {
        border-bottom: 1px solid var(--slate-100);
        transition: background var(--transition);
    }

    .h-table tbody tr:last-child { border-bottom: none; }
    .h-table tbody tr:hover { background: var(--slate-50); }

    .h-table td {
        padding: 1rem 1.75rem;
        color: var(--slate-700);
        vertical-align: middle;
    }

    .h-table td.td-date {
        color: var(--slate-400);
        font-size: .8rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .h-table td.td-name {
        font-weight: 600;
        color: var(--slate-800);
    }

    .h-table td.td-disease {
        font-weight: 700;
        color: var(--slate-800);
    }

    .h-table td.td-val {
        font-weight: 700;
        color: var(--slate-900);
        font-size: .88rem;
    }

    /* Avatar inisial petani */
    .user-cell {
        display: flex;
        align-items: center;
        gap: .65rem;
    }

    .user-avatar {
        width: 30px; height: 30px;
        border-radius: 8px;
        background: var(--blue-50);
        color: var(--blue-600);
        font-size: .72rem;
        font-weight: 800;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        text-transform: uppercase;
    }

    /* ─────────────────────────────────────────
       BADGE KETERANGAN  (sama sistem dengan user)
    ───────────────────────────────────────── */
    .badge-conf {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        font-size: .75rem;
        font-weight: 700;
        padding: .3rem .8rem;
        border-radius: 999px;
    }

    .badge-conf .dot {
        width: 5px; height: 5px;
        border-radius: 50%;
    }

    .badge-conf.high     { background: var(--emerald-50); color: var(--emerald-600); }
    .badge-conf.medium   { background: var(--amber-50);   color: var(--amber-600); }
    .badge-conf.low      { background: var(--rose-50);    color: var(--rose-500); }
    .badge-conf.none     { background: var(--slate-100);  color: var(--slate-500); }

    .badge-conf.high   .dot { background: var(--emerald-500); }
    .badge-conf.medium .dot { background: var(--amber-500); }
    .badge-conf.low    .dot { background: var(--rose-500); }
    .badge-conf.none   .dot { background: var(--slate-400); }

    /* Empty state */
    .h-empty {
        text-align: center;
        padding: 3.5rem 1rem;
        color: var(--slate-400);
    }

    .h-empty .h-empty-icon {
        font-size: 2.25rem;
        margin-bottom: .75rem;
        opacity: .35;
    }

    .h-empty p {
        font-size: .85rem;
        margin: 0;
        font-weight: 500;
    }

    /* ─────────────────────────────────────────
       RESPONSIVE
    ───────────────────────────────────────── */
    @media (max-width: 640px) {
        .db-wrap { padding: 1.5rem 1rem 3rem; }
        .db-header { margin-bottom: 1.5rem; }
        .h-table thead th,
        .h-table td { padding-left: 1rem; padding-right: 1rem; }
    }
</style>

<div class="db-wrap">

    {{-- ─── PAGE HEADER ─── --}}
    <div class="db-header">
        <div class="db-header-left">
            <h1>Dashboard Admin</h1>
            <p>Ringkasan data dan aktivitas sistem pakar</p>
        </div>
        <div class="db-date-pill" id="live-date"></div>
    </div>

    {{-- ─── STAT CARDS ─── --}}
    <div class="stat-row">

        <div class="stat-card s-green">
            <div class="stat-icon">🦠</div>
            <div class="stat-info">
                <div class="stat-label">Total Penyakit</div>
                <div class="stat-num">{{ $stats['penyakit'] }}</div>
                <div class="stat-desc">jenis penyakit tersedia</div>
            </div>
        </div>

        <div class="stat-card s-blue">
            <div class="stat-icon">🔬</div>
            <div class="stat-info">
                <div class="stat-label">Total Gejala</div>
                <div class="stat-num">{{ $stats['gejala'] }}</div>
                <div class="stat-desc">parameter diagnosa</div>
            </div>
        </div>

        <div class="stat-card s-amber">
            <div class="stat-icon">📋</div>
            <div class="stat-info">
                <div class="stat-label">Total Diagnosa</div>
                <div class="stat-num">{{ $stats['diagnosa'] }}</div>
                <div class="stat-desc">seluruh riwayat diagnosa</div>
            </div>
        </div>

        <div class="stat-card s-rose">
            <div class="stat-icon">👨‍🌾</div>
            <div class="stat-info">
                <div class="stat-label">Total Petani</div>
                <div class="stat-num">{{ $stats['users'] }}</div>
                <div class="stat-desc">pengguna terdaftar</div>
            </div>
        </div>

    </div>

    {{-- ─── MIDDLE: CHART + TOP PENYAKIT ─── --}}
    <div class="mid-grid">

        {{-- Bar Chart --}}
        <div class="chart-card">
            <div class="card-title">
                <span class="ct-icon blue">📊</span>
                Grafik Diagnosa per Penyakit
            </div>
            <canvas id="chartDiagnosa" height="110"></canvas>
        </div>

        {{-- Top Penyakit --}}
        <div class="top-card">
            <div class="card-title">
                <span class="ct-icon amber">🏆</span>
                Top Penyakit Terdeteksi
            </div>

            @php $maxCount = $diagnosaPerPenyakit->max('diagnosa_count') ?: 1; @endphp

            @foreach($diagnosaPerPenyakit->take(5) as $i => $p)
                @php
                    $rankClass = match($i) { 0 => 'r1', 1 => 'r2', 2 => 'r3', default => '' };
                    $pct = round(($p->diagnosa_count / $maxCount) * 100);
                @endphp
                <div class="top-item">
                    <div class="top-rank {{ $rankClass }}">{{ $i + 1 }}</div>
                    <div style="flex:1; min-width:0;">
                        <div class="top-name">{{ $p->nama_penyakit }}</div>
                        <div class="top-bar">
                            <div class="top-bar-fill" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>
                    <span class="top-badge">{{ $p->diagnosa_count }}x</span>
                </div>
            @endforeach

            @if($diagnosaPerPenyakit->isEmpty())
                <div style="text-align:center; padding:2rem 0; color:var(--slate-400); font-size:.85rem;">
                    Belum ada data diagnosa
                </div>
            @endif
        </div>

    </div>

    {{-- ─── TABEL RIWAYAT TERBARU ─── --}}
    <div class="history-wrap">

        <div class="history-header">
            <div class="hh-left">
                <h2>Riwayat Diagnosa Terbaru</h2>
                <span class="hh-count">{{ count($riwayatTerbaru) }} entri</span>
            </div>
            <a href="{{ route('admin.diagnosa.index') }}" class="btn-lihat">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="table-responsive">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Petani</th>
                        <th>Penyakit</th>
                        <th>Nilai WP</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatTerbaru as $d)
                        @php
                            $pct = round($d->nilai_hasil * 100);
                            $cls = $pct >= 75 ? 'high' : ($pct >= 50 ? 'medium' : ($pct > 0 ? 'low' : 'none'));
                            $initials = collect(explode(' ', $d->nama_user))->take(2)->map(fn($w) => strtoupper($w[0]))->implode('');
                        @endphp
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">{{ $initials }}</div>
                                    <span class="td-name">{{ $d->nama_user }}</span>
                                </div>
                            </td>
                            <td class="td-disease">{{ $d->penyakit?->nama_penyakit ?? '–' }}</td>
                            <td class="td-val">{{ number_format($d->nilai_hasil, 4) }}</td>
                            <td>
                                <span class="badge-conf {{ $cls }}">
                                    <span class="dot"></span>
                                    {{ $d->keterangan }}
                                </span>
                            </td>
                            <td class="td-date">{{ $d->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="h-empty">
                                    <div class="h-empty-icon">📂</div>
                                    <p>Belum ada riwayat diagnosa</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>{{-- end db-wrap --}}

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
/* ── Live date ── */
(function () {
    const el = document.getElementById('live-date');
    const now = new Date();
    el.textContent = now.toLocaleDateString('id-ID', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });
})();

/* ── Bar Chart ── */
(function () {
    const labels = {!! json_encode($diagnosaPerPenyakit->pluck('nama_penyakit')) !!};
    const values = {!! json_encode($diagnosaPerPenyakit->pluck('diagnosa_count')) !!};
    const ctx    = document.getElementById('chartDiagnosa');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Diagnosa',
                data: values,
                backgroundColor: 'rgba(16,185,129,.12)',
                borderColor:     '#10b981',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(16,185,129,.22)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    cornerRadius: 10,
                    padding: 10,
                    bodyFont: { family: 'Plus Jakarta Sans', size: 12 },
                    titleFont: { family: 'Plus Jakarta Sans', size: 12, weight: '700' },
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9', drawBorder: false },
                    ticks: {
                        stepSize: 1,
                        font: { family: 'Plus Jakarta Sans', size: 11 },
                        color: '#94a3b8',
                        padding: 8
                    },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { family: 'Plus Jakarta Sans', size: 11 },
                        color: '#94a3b8',
                        padding: 8
                    },
                    border: { display: false }
                }
            }
        }
    });
})();
</script>
@endsection