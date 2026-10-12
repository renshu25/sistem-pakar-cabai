@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<style>
    /* ─────────────────────────────────────────
       DESIGN TOKENS
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
        width: 6px;
        height: 6px;
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
       STAT CARDS  (3 cards)
    ───────────────────────────────────────── */
    .stat-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.1rem;
        margin-bottom: 1.75rem;
    }

    @media (max-width: 900px) { .stat-row { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 560px) { .stat-row { grid-template-columns: 1fr; } }

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

    /* top accent bar */
    .stat-card::after {
        content: '';
        position: absolute;
        inset: 0 0 auto 0;
        height: 3px;
        border-radius: var(--radius) var(--radius) 0 0;
    }

    .stat-card.s-blue::after   { background: var(--blue-500); }
    .stat-card.s-green::after  { background: var(--emerald-500); }
    .stat-card.s-amber::after  { background: var(--amber-500); }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .s-blue  .stat-icon { background: var(--blue-50);    color: var(--blue-600); }
    .s-green .stat-icon { background: var(--emerald-50); color: var(--emerald-600); }
    .s-amber .stat-icon { background: var(--amber-50);   color: var(--amber-600); }

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
       MIDDLE SECTION  (chart + last diagnosis)
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
        min-height: 360px;
        background: var(--white);
        border-radius: var(--radius);
        padding: 1.6rem 1.75rem;
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
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
        background: var(--blue-50);
        color: var(--blue-600);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: .9rem;
    }

    /* Last Diagnosis card */
    .last-diag-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 1.6rem 1.75rem;
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
        cursor: pointer;
        transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
        position: relative;
        overflow: hidden;
    }

    .last-diag-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: var(--blue-200, #bfdbfe);
    }

    .last-diag-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--blue-50) 0%, transparent 60%);
        opacity: 0;
        transition: opacity var(--transition);
        pointer-events: none;
    }

    .last-diag-card:hover::before { opacity: 1; }

    .ld-label {
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
        color: var(--slate-400);
        margin-bottom: 1rem;
        display: flex; align-items: center; gap: .4rem;
    }

    .ld-label::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--blue-500);
    }

    .ld-disease {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--slate-900);
        letter-spacing: -.3px;
        line-height: 1.3;
        margin-bottom: 1rem;
    }

    .ld-disease.empty {
        font-size: 1rem;
        font-weight: 500;
        color: var(--slate-400);
        font-style: italic;
    }

    .ld-confidence {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .78rem;
        font-weight: 700;
        padding: .35rem .85rem;
        border-radius: 999px;
        margin-bottom: 1.5rem;
    }

    .ld-confidence.high   { background: var(--emerald-50); color: var(--emerald-600); }
    .ld-confidence.medium { background: var(--amber-50);   color: var(--amber-600); }
    .ld-confidence.low    { background: var(--rose-50);    color: var(--rose-500); }

    .ld-cta {
        display: flex;
        align-items: center;
        gap: .4rem;
        font-size: .78rem;
        font-weight: 600;
        color: var(--blue-600);
        border-top: 1px solid var(--slate-100);
        padding-top: 1rem;
        margin-top: .25rem;
        transition: gap var(--transition);
    }

    .last-diag-card:hover .ld-cta { gap: .7rem; }

    .ld-cta svg {
        transition: transform var(--transition);
    }

    .last-diag-card:hover .ld-cta svg { transform: translateX(3px); }

    /* ─────────────────────────────────────────
       HISTORY TABLE (collapsible)
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
        cursor: pointer;
        user-select: none;
    }

    .history-header:hover { background: var(--slate-50); }

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

    .hh-toggle {
        width: 28px; height: 28px;
        border-radius: 8px;
        background: var(--slate-100);
        display: flex; align-items: center; justify-content: center;
        transition: background var(--transition), transform var(--transition);
    }

    .history-header:hover .hh-toggle { background: var(--blue-50); }

    .hh-toggle svg { transition: transform var(--transition); }

    .history-wrap.open .hh-toggle svg { transform: rotate(180deg); }

    /* Collapsible body */
    .history-body {
        max-height: 0;
        overflow: hidden;
        transition: max-height .42s cubic-bezier(.4,0,.2,1);
    }

    .history-wrap.open .history-body {
        max-height: 2000px;
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

    .h-table td.td-disease {
        font-weight: 700;
        color: var(--slate-800);
    }

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

    .badge-conf.high   { background: var(--emerald-50); color: var(--emerald-600); }
    .badge-conf.medium { background: var(--amber-50);   color: var(--amber-600); }
    .badge-conf.low    { background: var(--rose-50);    color: var(--rose-500); }

    .badge-conf.high   .dot { background: var(--emerald-500); }
    .badge-conf.medium .dot { background: var(--amber-500); }
    .badge-conf.low    .dot { background: var(--rose-500); }

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
       RESPONSIVE TWEAKS
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
            <h1>Dashboard</h1>
            <p>Ringkasan aktivitas diagnosa pengguna</p>
        </div>
        <div class="db-date-pill" id="live-date"></div>
    </div>

    {{-- ─── STAT CARDS ─── --}}
    <div class="stat-row">

        <div class="stat-card s-blue">
            <div class="stat-icon">🦠</div>
            <div class="stat-info">
                <div class="stat-label">Total Penyakit</div>
                <div class="stat-num">{{ $totalPenyakit }}</div>
                <div class="stat-desc">jenis penyakit tersedia</div>
            </div>
        </div>

        <div class="stat-card s-green">
            <div class="stat-icon">🔬</div>
            <div class="stat-info">
                <div class="stat-label">Total Gejala</div>
                <div class="stat-num">{{ $totalGejala }}</div>
                <div class="stat-desc">parameter diagnosa</div>
            </div>
        </div>

        <div class="stat-card s-amber">
            <div class="stat-icon">📋</div>
            <div class="stat-info">
                <div class="stat-label">Total Diagnosa</div>
                <div class="stat-num">{{ $riwayat->count() }}</div>
                <div class="stat-desc">riwayat diagnosa Anda</div>
            </div>
        </div>

    </div>

    {{-- ─── MIDDLE: CHART + LAST DIAGNOSIS ─── --}}
    <div class="mid-grid">

        {{-- Bar Chart --}}
        <div class="chart-card">
            <div class="card-title">
                <span class="ct-icon">📊</span>
                Grafik Diagnosa Penyakit
            </div>
            <canvas id="chartDiagnosa" height="140"></canvas>
        </div>

        {{-- Last Diagnosis Card --}}
        <div class="last-diag-card" id="lastDiagCard" onclick="toggleHistory()" role="button" tabindex="0"
             onkeydown="if(event.key==='Enter'||event.key===' ')toggleHistory()">

            <div class="ld-label">Diagnosa Terakhir</div>

            @if($riwayat->count() > 0)
                @php
                    $last = $riwayat->first();
                    $pct  = round($last->nilai_hasil * 100);
                    $cls  = $pct >= 75 ? 'high' : ($pct >= 50 ? 'medium' : 'low');
                @endphp
                <div class="ld-disease">{{ $last->penyakit->nama_penyakit ?? '-' }}</div>
                <div class="ld-confidence {{ $cls }}">
                    @if($cls === 'high')   ✓ @elseif($cls === 'medium') ~ @else ! @endif
                    {{ $pct }}% keyakinan
                </div>
                <div class="ld-cta">
                    Lihat riwayat diagnosa
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            @else
                <div class="ld-disease empty">Belum ada diagnosa</div>
                <div class="ld-cta" style="color:var(--slate-400)">
                    Mulai diagnosa pertama Anda
                </div>
            @endif

        </div>

    </div>

    {{-- ─── RIWAYAT (collapsible) ─── --}}
    <div class="history-wrap" id="historyWrap">

        <div class="history-header" onclick="toggleHistory()" role="button" tabindex="0"
             onkeydown="if(event.key==='Enter'||event.key===' ')toggleHistory()">
            <div class="hh-left">
                <h2>Riwayat Diagnosa Saya</h2>
                <span class="hh-count">{{ $riwayat->count() }} entri</span>
            </div>
            <div class="hh-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>

        <div class="history-body" id="historyBody">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Hasil Diagnosa</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $r)
                        @php $p = round($r->nilai_hasil * 100); $c = $p >= 75 ? 'high' : ($p >= 50 ? 'medium' : 'low'); @endphp
                        <tr>
                            <td class="td-date">{{ $r->created_at->format('d M Y, H:i') }}</td>
                            <td class="td-disease">{{ $r->penyakit->nama_penyakit ?? '-' }}</td>
                            <td>
                                <span class="badge-conf {{ $c }}">
                                    <span class="dot"></span>
                                    {{ $p }}%
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
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

{{-- Chart.js --}}
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
    const labels = {!! json_encode($chartData->keys()) !!};
    const values = {!! json_encode($chartData->values()) !!};
    const ctx    = document.getElementById('chartDiagnosa');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah Diagnosa',
                data: values,
                backgroundColor: 'rgba(59,130,246,.12)',
                borderColor:     '#3b82f6',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(59,130,246,.22)',
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

/* ── Toggle history ── */
function toggleHistory() {
    const wrap = document.getElementById('historyWrap');

    // buka / tutup
    wrap.classList.toggle('open');

    // jika terbuka → auto scroll
    if (wrap.classList.contains('open')) {
        setTimeout(() => {
            wrap.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 200);
    }
}
</script>

@endsection