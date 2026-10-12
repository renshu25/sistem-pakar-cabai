@extends('layouts.user')
@section('title','Diagnosa Penyakit')
@section('content')

<style>
/* ── Card utama ── */
.diagnosa-card {
    background: #fff;
    border: 1px solid #e8f5e9;
    border-radius: 14px;
    padding: 2rem;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
}

/* ── Header ── */
.diagnosa-header {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding-bottom: 1.25rem;
    border-bottom: 1px solid #e8f5e9;
    margin-bottom: 1.5rem;
}
.diagnosa-header-icon {
    width: 46px;
    height: 46px;
    background: #e8f5e9;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.diagnosa-header-icon i { font-size: 22px; color: #2e7d32; }
.diagnosa-header h5 {
    font-size: 16px;
    font-weight: 600;
    color: #1b1b1b;
    margin-bottom: 4px;
}
.diagnosa-header p {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
    line-height: 1.5;
}

/* ── Search ── */
.search-wrapper {
    position: relative;
    margin-bottom: .75rem;
}
.search-wrapper .bi-search {
    position: absolute;
    left: 11px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 14px;
}
.search-wrapper input {
    width: 100%;
    padding: 8px 12px 8px 34px;
    font-size: 13px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    color: #111;
    outline: none;
    transition: border-color .15s, box-shadow .15s;
}
.search-wrapper input:focus {
    border-color: #4caf50;
    box-shadow: 0 0 0 3px rgba(76,175,80,.15);
    background: #fff;
}

/* ── Counter badge ── */
.selected-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #6b7280;
    margin-bottom: .6rem;
}
.selected-badge .count {
    background: #e8f5e9;
    color: #2e7d32;
    border-radius: 20px;
    padding: 1px 9px;
    font-size: 12px;
    font-weight: 600;
}

/* ── Tabel ── */
.gejala-table-wrap {
    border: 1px solid #e8f5e9;
    border-radius: 10px;
    overflow: hidden;
}
.gejala-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}
.gejala-table thead tr {
    background: #e8f5e9;
}
.gejala-table thead th {
    padding: 10px 16px;
    font-weight: 600;
    font-size: 12px;
    color: #2e7d32;
    text-transform: uppercase;
    letter-spacing: .04em;
    border-bottom: 1px solid #c8e6c9;
}
.gejala-table tbody tr {
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;               /* ← tunjukkan baris bisa diklik */
    transition: background .12s;
    user-select: none;             /* ← cegah seleksi teks saat klik */
}
.gejala-table tbody tr:last-child { border-bottom: none; }
.gejala-table tbody tr:hover      { background: #f0fdf4; }
.gejala-table tbody tr.row-active { background: #dcfce7; }

.gejala-table td { padding: 12px 16px; vertical-align: middle; color: #111; }
.gejala-table td:first-child { width: 54px; text-align: center; }
.gejala-table td:nth-child(2) { width: 110px; text-align: center; }

/* ── Checkbox custom besar ── */
.gejala-chk {
    width: 20px;
    height: 20px;
    border: 2px solid #9ca3af;
    border-radius: 5px;
    appearance: none;
    cursor: pointer;
    background: #fff;
    transition: all .15s;
    position: relative;
    pointer-events: none;    /* klik ditangani oleh <tr> */
    flex-shrink: 0;
}
.gejala-chk:checked {
    background: #2e7d32;
    border-color: #2e7d32;
}
.gejala-chk:checked::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 1px;
    width: 6px;
    height: 11px;
    border: 2.5px solid #fff;
    border-left: none;
    border-top: none;
    transform: rotate(45deg);
}

/* ── Kode badge ── */
.kode-pill {
    display: inline-block;
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 2px 10px;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    font-family: monospace;
}

/* ── Empty state ── */
.empty-state {
    text-align: center;
    padding: 2.5rem 1rem;
    color: #9ca3af;
    font-size: 13px;
}
.empty-state i { font-size: 30px; display: block; margin-bottom: .5rem; }

/* ── Footer tombol ── */
.diagnosa-footer {
    display: flex;
    gap: 10px;
    margin-top: 1.25rem;
    padding-top: 1.25rem;
    border-top: 1px solid #e8f5e9;
}
.btn-diagnosa {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 22px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: background .15s, opacity .15s;
}
.btn-diagnosa-primary {
    background: #2e7d32;
    color: #fff;
}
.btn-diagnosa-primary:hover   { background: #1b5e20; }
.btn-diagnosa-primary:disabled { background: #a5d6a7; cursor: not-allowed; }
.btn-diagnosa-reset {
    background: transparent;
    border: 1px solid #d1d5db;
    color: #6b7280;
}
.btn-diagnosa-reset:hover { background: #f9fafb; }
</style>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="diagnosa-card">

            {{-- Header --}}
            <div class="diagnosa-header">
                <div>
                    <h5>Diagnosa Penyakit Tanaman Cabai</h5>
                    <p>Pilih gejala yang ditemukan pada tanaman. Sistem akan memproses diagnosa menggunakan metode <strong>Rule-Based</strong> dan <strong>Weighted Product</strong>.</p>
                </div>
            </div>

            <form action="{{ route('user.diagnosa.proses') }}" method="POST" id="formDiagnosa">
                @csrf

                @error('gejala')
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="font-size:13px;border-radius:8px">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        {{ $message }}
                    </div>
                @enderror

<form action="{{ route('user.diagnosa.proses') }}" method="POST" id="formDiagnosa">
    @csrf

    @if(session('error'))
        <div class="alert alert-warning d-flex align-items-center gap-2 mb-3"
             style="font-size:13px;border-radius:8px">
            <i class="bi bi-exclamation-triangle-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    @error('gejala')
        <div class="alert alert-danger d-flex align-items-center gap-2 mb-3"
             style="font-size:13px;border-radius:8px">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ $message }}
        </div>
    @enderror

                {{-- Search --}}
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text"
                           id="searchGejala"
                           placeholder="Cari gejala..."
                           oninput="filterGejala(this.value)"
                           autocomplete="off">
                </div>

                {{-- Counter --}}
                <div class="selected-badge">
                    Gejala dipilih:
                    <span class="count" id="selectedCount">0</span>
                </div>

                {{-- Tabel --}}
                <div class="gejala-table-wrap">
                    <table class="gejala-table">
                        <thead>
                            <tr>
                                <th class="text-center">Pilih</th>
                                <th class="text-center">Kode</th>
                                <th>Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody id="gejalaBody">
                            @forelse($gejalaData as $g)
                            <tr id="row-{{ $g->kode_gejala }}"
                                onclick="toggleRow('{{ $g->kode_gejala }}')">
                                <td>
                                    <input type="checkbox"
                                           class="gejala-chk"
                                           name="gejala[]"
                                           value="{{ $g->kode_gejala }}"
                                           id="gejala-{{ $g->kode_gejala }}">
                                </td>
                                <td>
                                    <span class="kode-pill">{{ $g->kode_gejala }}</span>
                                </td>
                                <td>{{ $g->nama_gejala }}</td>
                            </tr>
                            @empty
                            <tr id="emptyRow">
                                <td colspan="3">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        Data gejala belum tersedia.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer --}}
                <div class="diagnosa-footer">
                    <button type="submit"
                            class="btn-diagnosa btn-diagnosa-primary"
                            id="btnProses"
                            disabled>
                        <i class="bi bi-cpu"></i>
                        Proses Diagnosa
                    </button>
                    <button type="button"
                            class="btn-diagnosa btn-diagnosa-reset"
                            onclick="resetAll()">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
/* ── Toggle baris: klik mana saja di baris = centang/hapus ── */
function toggleRow(kode) {
    const chk = document.getElementById('gejala-' + kode);
    const row = document.getElementById('row-' + kode);
    if (!chk || !row) return;

    chk.checked = !chk.checked;

    if (chk.checked) {
        row.classList.add('row-active');
    } else {
        row.classList.remove('row-active');
    }
    updateCounter();
}

/* ── Hitung gejala terpilih & aktifkan tombol ── */
function updateCounter() {
    const total = document.querySelectorAll('.gejala-chk:checked').length;
    document.getElementById('selectedCount').textContent = total;
    document.getElementById('btnProses').disabled = total === 0;
}

/* ── Filter / pencarian gejala ── */
function filterGejala(q) {
    const keyword = q.trim().toLowerCase();
    const rows    = document.querySelectorAll('#gejalaBody tr[id^="row-"]');
    let visible   = 0;

    rows.forEach(row => {
        const teks = row.querySelector('td:last-child').textContent.toLowerCase();
        const kode = row.querySelector('.kode-pill').textContent.toLowerCase();
        const cocok = !keyword || teks.includes(keyword) || kode.includes(keyword);
        row.style.display = cocok ? '' : 'none';
        if (cocok) visible++;
    });

    /* Tampilkan pesan kalau tidak ada hasil */
    let noResult = document.getElementById('noResultRow');
    if (!visible) {
        if (!noResult) {
            noResult = document.createElement('tr');
            noResult.id = 'noResultRow';
            noResult.innerHTML = `<td colspan="3">
                <div class="empty-state">
                    <i class="bi bi-search"></i>
                    Gejala "<strong>${q}</strong>" tidak ditemukan.
                </div></td>`;
            document.getElementById('gejalaBody').appendChild(noResult);
        }
    } else if (noResult) {
        noResult.remove();
    }
}

/* ── Reset semua ── */
function resetAll() {
    document.querySelectorAll('.gejala-chk').forEach(c => c.checked = false);
    document.querySelectorAll('tr[id^="row-"]').forEach(r => r.classList.remove('row-active'));
    document.getElementById('searchGejala').value = '';
    filterGejala('');
    updateCounter();
}
</script>
@endsection