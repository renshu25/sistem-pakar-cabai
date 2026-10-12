@extends('layouts.admin')
@section('title', 'Basis Aturan')
@section('page-title', 'Manajemen Basis Aturan (Rule)')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* ─────────────────────────────────────────
       DESIGN TOKENS  (selaras dengan admin dashboard)
    ───────────────────────────────────────── */
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

        --violet-50:   #f5f3ff;
        --violet-100:  #ede9fe;
        --violet-500:  #8b5cf6;
        --violet-600:  #7c3aed;

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

    *, *::before, *::after { box-sizing: border-box; }

    .rule-wrap {
        background: var(--slate-100);
        min-height: 100vh;
        padding: 2.25rem 2rem 4rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ─── PAGE HEADER ─── */
    .rule-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2.25rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .rule-page-header h1 {
        font-size: 1.625rem;
        font-weight: 800;
        color: var(--slate-900);
        letter-spacing: -.4px;
        margin: 0 0 .2rem;
    }

    .rule-page-header p {
        font-size: .825rem;
        color: var(--slate-400);
        margin: 0;
        font-weight: 500;
    }

    /* ─── BTN TAMBAH ─── */
    .btn-tambah-rule {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-size: .82rem;
        font-weight: 700;
        color: var(--white);
        background: var(--blue-600);
        border: none;
        border-radius: var(--radius-sm);
        padding: .65rem 1.25rem;
        text-decoration: none;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(37,99,235,.25);
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-tambah-rule:hover {
        background: var(--blue-700);
        border-color: var(--blue-700);
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(37,99,235,.35);
        color: var(--white);
    }

    /* ─── STAT CHIPS ─── */
    .stat-chips {
        display: flex;
        gap: .75rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .stat-chip {
        display: flex;
        align-items: center;
        gap: .5rem;
        background: var(--white);
        border: 1px solid var(--slate-200);
        border-radius: 999px;
        padding: .45rem 1.1rem;
        font-size: .78rem;
        font-weight: 700;
        color: var(--slate-600);
        box-shadow: var(--shadow-sm);
    }

    .stat-chip .chip-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
    }

    .chip-green .chip-dot  { background: var(--emerald-500); }
    .chip-violet .chip-dot { background: var(--violet-500); }
    .chip-blue .chip-dot   { background: var(--blue-500); }

    /* ─── ALERT ─── */
    .alert-success {
        display: flex;
        align-items: center;
        gap: .75rem;
        background: var(--emerald-50);
        color: #065f46;
        border: 1px solid var(--emerald-100);
        border-radius: var(--radius-sm);
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        font-size: .85rem;
        font-weight: 600;
    }

    /* ─── CARD TABLE ─── */
    .card-rule {
        background: var(--white);
        border-radius: var(--radius);
        border: 1px solid var(--slate-200);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    /* ─── TABLE ─── */
    .table-rule {
        width: 100%;
        border-collapse: collapse;
        font-size: .86rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .table-rule thead th {
        background: var(--slate-50);
        color: var(--slate-400);
        font-size: .7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .65px;
        padding: .9rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid var(--slate-200);
    }

    .table-rule tbody tr {
        border-bottom: 1px solid var(--slate-100);
        transition: background var(--transition);
    }

    .table-rule tbody tr:last-child { border-bottom: none; }
    .table-rule tbody tr:hover { background: var(--slate-50); }

    .table-rule td {
        padding: 1.1rem 1.5rem;
        color: var(--slate-700);
        vertical-align: middle;
    }

    /* ─── RULE ID BADGE ─── */
    .badge-rule-id {
        font-size: .72rem;
        font-weight: 800;
        color: var(--blue-600);
        background: var(--blue-50);
        border: 1px solid var(--blue-100);
        border-radius: 7px;
        padding: .3rem .65rem;
        letter-spacing: .3px;
        font-family: 'Plus Jakarta Sans', monospace;
    }

    /* ─── DISEASE NAME ─── */
    .disease-name {
        font-weight: 700;
        color: var(--slate-800);
        display: block;
        font-size: .875rem;
    }

    .disease-code {
        font-size: .72rem;
        color: var(--slate-400);
        font-weight: 500;
        margin-top: .15rem;
        display: block;
    }

    /* ─── GEJALA BADGES ─── */
    .badge-gejala {
        display: inline-flex;
        align-items: center;
        background: var(--emerald-50);
        color: var(--emerald-600);
        font-weight: 700;
        padding: .2rem .55rem;
        border-radius: 6px;
        font-size: .72rem;
        margin: .15rem;
        border: 1px solid var(--emerald-100);
        cursor: default;
        transition: background var(--transition);
    }

    .badge-gejala:hover {
        background: var(--emerald-100);
    }

    .badge-empty {
        color: var(--slate-300);
        font-style: italic;
        font-size: .8rem;
    }

    /* ─── ACTION BUTTONS ─── */
    .btn-edit-rule {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .76rem;
        font-weight: 700;
        color: var(--violet-600);
        background: var(--violet-50);
        border: 1px solid var(--violet-100);
        border-radius: 8px;
        padding: .45rem .9rem;
        cursor: pointer;
        transition: all var(--transition);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-edit-rule:hover {
        background: var(--violet-600);
        color: var(--white);
        border-color: var(--violet-600);
        transform: translateY(-1px);
    }

    /* Empty state */
    .empty-row td {
        text-align: center;
        padding: 3.5rem 1rem;
        color: var(--slate-400);
    }

    .empty-icon {
        font-size: 2.25rem;
        margin-bottom: .6rem;
        opacity: .35;
    }

    .empty-text {
        font-size: .85rem;
        font-weight: 500;
    }

    /* ─────────────────────────────────────────
       MODAL  (Shared Style)
    ───────────────────────────────────────── */
    .modal-content {
        border-radius: var(--radius) !important;
        border: none !important;
        box-shadow: var(--shadow-md);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .modal-header {
        border-bottom: 1px solid var(--slate-100) !important;
        padding: 1.4rem 1.6rem !important;
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .modal-header-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .modal-header-icon.violet { background: var(--violet-50); }
    .modal-header-icon.blue   { background: var(--blue-50); }

    .modal-title {
        font-size: .95rem !important;
        font-weight: 800 !important;
        color: var(--slate-900) !important;
        margin: 0;
    }

    .modal-subtitle {
        font-size: .72rem;
        color: var(--slate-400);
        font-weight: 500;
        margin-top: .1rem;
    }

    .modal-body {
        padding: 1.5rem 1.6rem !important;
    }

    .modal-footer {
        border-top: 1px solid var(--slate-100) !important;
        padding: 1.1rem 1.6rem !important;
        gap: .5rem;
        display: flex;
    }

    /* ─── Form elements ─── */
    .form-label-custom {
        font-size: .75rem;
        font-weight: 700;
        color: var(--slate-600);
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: .5rem;
        display: block;
    }

    .form-select-custom,
    .form-input-custom {
        width: 100%;
        border: 1.5px solid var(--slate-200);
        border-radius: var(--radius-sm);
        padding: .65rem .9rem;
        font-size: .85rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--slate-700);
        background: var(--white);
        transition: border-color var(--transition), box-shadow var(--transition);
        appearance: none;
        -webkit-appearance: none;
        outline: none;
    }

    .form-select-custom {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right .75rem center;
        padding-right: 2.25rem;
    }

    .form-select-custom:focus,
    .form-input-custom:focus {
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,.12);
    }

    /* ─── Gejala checkbox list ─── */
    .gejala-list {
        display: flex;
        flex-direction: column;
        gap: .5rem;
        max-height: 320px;
        overflow-y: auto;
        padding-right: .25rem;
    }

    .gejala-list::-webkit-scrollbar { width: 4px; }
    .gejala-list::-webkit-scrollbar-track { background: var(--slate-100); border-radius: 99px; }
    .gejala-list::-webkit-scrollbar-thumb { background: var(--slate-300); border-radius: 99px; }

    .gejala-check-item {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .7rem .9rem;
        border: 1.5px solid var(--slate-200);
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: border-color var(--transition), background var(--transition);
    }

    .gejala-check-item:hover {
        border-color: var(--blue-200, #bfdbfe);
        background: var(--blue-50);
    }

    .gejala-check-item input[type="checkbox"] {
        width: 16px; height: 16px;
        border-radius: 4px;
        accent-color: var(--violet-600);
        flex-shrink: 0;
        cursor: pointer;
    }

    .gejala-check-item.is-checked {
        border-color: var(--violet-200, #ddd6fe);
        background: var(--violet-50);
    }

    .gejala-kode {
        font-size: .72rem;
        font-weight: 800;
        color: var(--blue-600);
        background: var(--blue-50);
        border-radius: 5px;
        padding: .15rem .45rem;
        flex-shrink: 0;
    }

    .gejala-nama {
        font-size: .83rem;
        color: var(--slate-600);
        font-weight: 500;
        flex: 1;
    }

    /* ─── Form group spacing ─── */
    .form-group { margin-bottom: 1.1rem; }
    .form-group:last-child { margin-bottom: 0; }

    /* ─── Search input in modal ─── */
    .search-gejala-wrap {
        position: relative;
        margin-bottom: .75rem;
    }

    .search-gejala-wrap svg {
        position: absolute;
        left: .75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate-400);
        pointer-events: none;
    }

    .search-gejala {
        width: 100%;
        border: 1.5px solid var(--slate-200);
        border-radius: var(--radius-sm);
        padding: .6rem .9rem .6rem 2.25rem;
        font-size: .82rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--slate-700);
        outline: none;
        transition: border-color var(--transition);
    }

    .search-gejala:focus { border-color: var(--blue-500); }

    /* ─── Footer buttons ─── */
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .8rem;
        font-weight: 600;
        color: var(--slate-500);
        background: var(--slate-100);
        border: 1px solid var(--slate-200);
        border-radius: 8px;
        padding: .55rem 1.1rem;
        cursor: pointer;
        transition: all var(--transition);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-cancel:hover {
        background: var(--slate-200);
        color: var(--slate-700);
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .8rem;
        font-weight: 700;
        color: var(--white);
        background: var(--blue-600);
        border: none;
        border-radius: 8px;
        padding: .55rem 1.3rem;
        cursor: pointer;
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 2px 8px rgba(37,99,235,.2);
    }

    .btn-save:hover {
        background: var(--blue-700);
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(37,99,235,.3);
    }

    .btn-save-violet {
        background: var(--violet-600);
        box-shadow: 0 2px 8px rgba(124,58,237,.2);
    }

    .btn-save-violet:hover {
        background: var(--violet-700, #6d28d9);
        box-shadow: 0 4px 16px rgba(124,58,237,.3);
    }

    /* ─── Divider in modal ─── */
    .modal-divider {
        height: 1px;
        background: var(--slate-100);
        margin: 1.1rem 0;
    }

    /* ─── Help text ─── */
    .help-text {
        font-size: .77rem;
        color: var(--slate-400);
        margin-top: .35rem;
        font-weight: 500;
    }

    /* ─── Info note ─── */
    .info-note {
        display: flex;
        align-items: flex-start;
        gap: .6rem;
        background: var(--blue-50);
        border: 1px solid var(--blue-100);
        border-radius: var(--radius-sm);
        padding: .75rem 1rem;
        font-size: .78rem;
        color: var(--blue-700);
        font-weight: 500;
        margin-bottom: 1.1rem;
    }

    .info-note-icon { flex-shrink: 0; font-size: .9rem; }

    @media (max-width: 640px) {
        .rule-wrap { padding: 1.5rem 1rem 3rem; }
        .table-rule th,
        .table-rule td { padding-left: 1rem; padding-right: 1rem; }
        .stat-chips { gap: .5rem; }
    }

    .btn-delete-rule{

    display:inline-flex;
    align-items:center;

    font-size:.76rem;
    font-weight:700;

    color:#dc2626;

    background:#fef2f2;

    border:1px solid #fecaca;

    border-radius:8px;

    padding:.45rem .9rem;

    cursor:pointer;

    transition:.2s;

    font-family:'Plus Jakarta Sans',sans-serif;

}


.btn-delete-rule:hover{

    background:#dc2626;

    color:white;

}

</style>

<div class="rule-wrap">

    {{-- ─── PAGE HEADER ─── --}}
    <div class="rule-page-header">
        <div>
            <h1>Basis Aturan (Rule-Based)</h1>
            <p>Kelola kombinasi gejala IF-THEN untuk setiap kandidat penyakit cabai</p>
        </div>
        <button class="btn-tambah-rule" data-bs-toggle="modal" data-bs-target="#modalTambahRule">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Rule
        </button>
    </div>

    {{-- ─── STAT CHIPS ─── --}}
    <div class="stat-chips">
        <div class="stat-chip chip-green">
            <span class="chip-dot"></span>
            {{ $penyakitData->count() }} Penyakit
        </div>
        <div class="stat-chip chip-violet">
            <span class="chip-dot"></span>
            {{ $gejalaData->count() }} Gejala
        </div>
        <div class="stat-chip chip-blue">
            <span class="chip-dot"></span>
            {{ $rules->count() }} Rule Aktif
        </div>
    </div>

    {{-- ─── ALERT ─── --}}
    @if(session('success'))
        <div class="alert-success">
            <span>✅</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- ─── TABLE CARD ─── --}}
    <div class="card-rule">
        <table class="table-rule">
            <thead>
                <tr>
                    <th style="width:90px;">ID Rule</th>
                    <th style="width:230px;">Penyakit</th>
                    <th>Gejala Terikat</th>
                    <th style="width:140px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>

@if($rules->count() > 0)

@foreach($rules as $rule)

<tr>

    <td>
        <span class="badge-rule-id">
            {{ $rule->kode_rule }}
        </span>
    </td>


    <td>
        <span class="disease-name">
            {{ $rule->penyakit->nama_penyakit }}
        </span>

        <span class="disease-code">
            {{ $rule->penyakit->kode_penyakit }}
        </span>
    </td>


    <td>
        @foreach($rule->gejala as $g)

            <span class="badge-gejala">
                {{ $g->kode_gejala }}
            </span>

        @endforeach
    </td>


<td style="text-align:center; display:flex; gap:5px; justify-content:center;">


    {{-- EDIT --}}
    <button class="btn-edit-rule"
        data-bs-toggle="modal"
        data-bs-target="#modalEditRule{{ $rule->kode_rule }}">

        Atur Gejala

    </button>



    {{-- DELETE --}}
    <form action="{{ route('admin.rule.destroy',$rule->kode_rule) }}"
          method="POST"
          onsubmit="return confirm('Hapus rule {{ $rule->kode_rule }} beserta semua gejala?')">

        @csrf
        @method('DELETE')


        <button type="submit"
                class="btn-delete-rule">

            Hapus

        </button>


    </form>


</td>

</tr>
</tr>


{{-- MODAL EDIT RULE --}}
<div class="modal fade" id="modalEditRule{{ $rule->kode_rule }}" tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">


<form action="{{ route('admin.rule.update', $rule->kode_rule) }}" method="POST">

@csrf
@method('PUT')


<div class="modal-header">

<h5 class="modal-title">
Edit Rule {{ $rule->kode_rule }}
</h5>

<button type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>



<div class="modal-body">


<div class="mb-3">

<label class="form-label">
Penyakit
</label>

<input type="text"
class="form-control"
value="{{ $rule->penyakit->nama_penyakit }}"
readonly>

</div>



<label class="form-label">
Pilih Gejala
</label>


<div class="gejala-list">


@foreach($gejalaData as $g)

@php
$checked = $rule->gejala->contains('id',$g->id);
@endphp


<label class="gejala-check-item">

<input type="checkbox"
name="gejala_ids[]"
value="{{ $g->id }}"
{{ $checked ? 'checked' : '' }}>


<span class="gejala-kode">
{{ $g->kode_gejala }}
</span>


<span class="gejala-nama">
{{ $g->nama_gejala }}
</span>


</label>


@endforeach


</div>


</div>



<div class="modal-footer">


<button type="button"
class="btn-cancel"
data-bs-dismiss="modal">

Batal

</button>


<button type="submit"
class="btn-save">

Simpan Perubahan

</button>


</div>


</form>


</div>

</div>

</div>


@endforeach


@else

<tr class="empty-row">
    <td colspan="4">

        <div class="empty-icon">📋</div>

        <p class="empty-text">
            Belum ada data rule.
        </p>

    </td>
</tr>


@endif

</tbody>
        </table>
    </div>

</div>{{-- end rule-wrap --}}


{{-- ═══════════════════════════════════════════════════════
     MODAL TAMBAH RULE BARU
═══════════════════════════════════════════════════════ --}}
<div class="modal fade" id="modalTambahRule" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content">
            <form action="{{ route('admin.rule.store') }}" method="POST">
                @csrf

                {{-- Header --}}
                <div class="modal-header">
                    <div class="modal-header-icon blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                             viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <div class="modal-title">Tambah Rule Baru</div>
                        <div class="modal-subtitle">Pilih penyakit &amp; gejala yang membentuk aturan baru</div>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal"></button>
                </div>

                {{-- Body --}}
                <div class="modal-body">

                    {{-- Pilih Penyakit --}}
                    <div class="form-group">
                        <label class="form-label-custom" for="selectPenyakit">
                            Penyakit Target
                        </label>
                        <select name="penyakit_id" id="selectPenyakit" class="form-select-custom" required>
                            <option value="" disabled selected>— Pilih penyakit —</option>
                            @foreach($penyakitData as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->kode_penyakit }} · {{ $p->nama_penyakit }}
                                </option>
                            @endforeach
                        </select>
                        <p class="help-text">Rule akan ditambahkan ke atas aturan gejala penyakit yang dipilih.</p>
                    </div>

                    <div class="modal-divider"></div>

                    {{-- Gejala --}}
                    <div class="form-group">
                        <label class="form-label-custom">Gejala yang Ditambahkan</label>

                        <div class="search-gejala-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
                            </svg>
                            <input type="text"
                                   class="search-gejala"
                                   placeholder="Cari kode atau nama gejala…"
                                   oninput="filterGejala(this, 'tambahList')"
                            >
                        </div>

                        <div class="gejala-list" id="tambahList">
                            @foreach($gejalaData as $g)
                                <label class="gejala-check-item"
                                       data-kode="{{ strtolower($g->kode_gejala) }}"
                                       data-nama="{{ strtolower($g->nama_gejala) }}">
                                    <input type="checkbox"
                                           name="gejala_ids[]"
                                           value="{{ $g->id }}"
                                           onchange="toggleCheckStyle(this)">
                                    <span class="gejala-kode">{{ $g->kode_gejala }}</span>
                                    <span class="gejala-nama">{{ $g->nama_gejala }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="help-text" style="margin-top:.6rem;" id="tambahCount">0 gejala dipilih</p>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-save">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Rule
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
/* ── Toggle checked style pada label ── */
function toggleCheckStyle(input) {
    const label = input.closest('.gejala-check-item');
    label.classList.toggle('is-checked', input.checked);

    // Update counter di modal tambah
    const list = input.closest('.gejala-list');
    if (list && list.id === 'tambahList') {
        const total = list.querySelectorAll('input[type="checkbox"]:checked').length;
        const counter = document.getElementById('tambahCount');
        if (counter) counter.textContent = `${total} gejala dipilih`;
    }
}

/* ── Filter/search gejala di dalam list ── */
function filterGejala(input, listId) {
    const query = input.value.toLowerCase().trim();
    const list  = document.getElementById(listId);
    if (!list) return;

    list.querySelectorAll('.gejala-check-item').forEach(item => {
        const kode = item.dataset.kode || '';
        const nama = item.dataset.nama || '';
        const match = kode.includes(query) || nama.includes(query);
        item.style.display = match ? '' : 'none';
    });
}

/* ── Saat modal edit dibuka, reset search field ── */
document.querySelectorAll('[id^="modalEditRule"]').forEach(modal => {
    modal.addEventListener('shown.bs.modal', function () {
        const searchInput = this.querySelector('.search-gejala');
        if (searchInput) {
            searchInput.value = '';
            filterGejala(searchInput, this.querySelector('.gejala-list').id);
        }
    });
});

/* ── Saat modal tambah dibuka, reset semua ── */
const modalTambah = document.getElementById('modalTambahRule');
if (modalTambah) {
    modalTambah.addEventListener('shown.bs.modal', function () {
        // Reset search
        const searchInput = this.querySelector('.search-gejala');
        if (searchInput) {
            searchInput.value = '';
            filterGejala(searchInput, 'tambahList');
        }
        // Uncheck semua
        this.querySelectorAll('input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
            cb.closest('.gejala-check-item').classList.remove('is-checked');
        });
        // Reset counter
        const counter = document.getElementById('tambahCount');
        if (counter) counter.textContent = '0 gejala dipilih';
        // Reset select
        const select = document.getElementById('selectPenyakit');
        if (select) select.selectedIndex = 0;
    });
}
</script>
@endsection