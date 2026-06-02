```blade id="9n4mwe"
@extends('layouts.admin')

@section('title', 'Data Penyakit')
@section('page-title', 'Penyakit')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root{
        --blue-50:#eff6ff;
        --blue-100:#dbeafe;
        --blue-500:#3b82f6;
        --blue-600:#2563eb;

        --emerald-50:#ecfdf5;
        --emerald-500:#10b981;
        --emerald-600:#059669;

        --rose-50:#fff1f2;
        --rose-500:#f43f5e;
        --rose-600:#e11d48;

        --slate-50:#f8fafc;
        --slate-100:#f1f5f9;
        --slate-200:#e2e8f0;
        --slate-300:#cbd5e1;
        --slate-400:#94a3b8;
        --slate-500:#64748b;
        --slate-700:#334155;
        --slate-800:#1e293b;
        --slate-900:#0f172a;

        --white:#ffffff;

        --radius:18px;
        --shadow:0 2px 8px rgba(15,23,42,.05),0 12px 30px rgba(15,23,42,.06);
        --transition:.22s cubic-bezier(.4,0,.2,1);
    }

    *{
        font-family:'Plus Jakarta Sans',sans-serif;
    }

    .page-wrap{
        background:var(--slate-100);
        min-height:100vh;
        padding:2rem;
    }

    .page-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:1.5rem;
        gap:1rem;
        flex-wrap:wrap;
    }

    .page-title h1{
        font-size:1.6rem;
        font-weight:800;
        color:var(--slate-900);
        margin:0;
    }

    .page-title p{
        margin:.35rem 0 0;
        color:var(--slate-400);
        font-size:.85rem;
    }

    .btn-add{
        border:none;
        background:var(--emerald-500);
        color:white;
        padding:.85rem 1.2rem;
        border-radius:12px;
        font-size:.85rem;
        font-weight:700;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:.5rem;
        transition:var(--transition);
        box-shadow:0 8px 20px rgba(16,185,129,.18);
    }

    .btn-add:hover{
        background:var(--emerald-600);
        transform:translateY(-2px);
        color:white;
    }

    .stat-card{
        background:var(--white);
        border-radius:var(--radius);
        border:1px solid var(--slate-200);
        box-shadow:var(--shadow);
        padding:1.5rem;
        margin-bottom:1.5rem;
        display:flex;
        align-items:center;
        gap:1rem;
    }

    .stat-icon{
        width:55px;
        height:55px;
        border-radius:16px;
        background:var(--emerald-50);
        color:var(--emerald-600);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:1.5rem;
    }

    .stat-label{
        font-size:.78rem;
        font-weight:700;
        color:var(--slate-400);
        text-transform:uppercase;
        letter-spacing:.6px;
        margin-bottom:.3rem;
    }

    .stat-number{
        font-size:2rem;
        font-weight:800;
        color:var(--slate-900);
        line-height:1;
    }

    .table-card{
        background:var(--white);
        border-radius:var(--radius);
        border:1px solid var(--slate-200);
        box-shadow:var(--shadow);
        overflow:hidden;
    }

    .table-header{
        padding:1.3rem 1.5rem;
        border-bottom:1px solid var(--slate-100);
        display:flex;
        align-items:center;
        justify-content:space-between;
    }

    .table-header h2{
        margin:0;
        font-size:1rem;
        font-weight:700;
        color:var(--slate-800);
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    thead th{
        background:var(--slate-50);
        padding:1rem 1.5rem;
        text-align:left;
        font-size:.72rem;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:.7px;
        color:var(--slate-400);
    }

    tbody td{
        padding:1rem 1.5rem;
        border-bottom:1px solid var(--slate-100);
        color:var(--slate-700);
        font-size:.88rem;
        vertical-align:top;
    }

    tbody tr:last-child td{
        border-bottom:none;
    }

    tbody tr:hover{
        background:var(--slate-50);
    }

    .kode-badge{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:.4rem .75rem;
        border-radius:999px;
        background:var(--blue-50);
        color:var(--blue-600);
        font-size:.72rem;
        font-weight:700;
    }

    .nama-penyakit{
        font-weight:700;
        color:var(--slate-800);
        margin-bottom:.25rem;
    }

    .desk{
        color:var(--slate-500);
        line-height:1.6;
        max-width:350px;
    }

    .gejala-wrap{
        display:flex;
        flex-wrap:wrap;
        gap:.45rem;
    }

    .gejala-badge{
        background:var(--emerald-50);
        color:var(--emerald-600);
        font-size:.72rem;
        font-weight:700;
        padding:.35rem .7rem;
        border-radius:999px;
    }

    .aksi-wrap{
        display:flex;
        gap:.6rem;
    }

    .btn-edit,
    .btn-delete{
        width:36px;
        height:36px;
        border-radius:10px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-decoration:none;
        transition:var(--transition);
        border:none;
    }

    .btn-edit{
        background:var(--blue-50);
        color:var(--blue-600);
    }

    .btn-delete{
        background:var(--rose-50);
        color:var(--rose-600);
    }

    .btn-edit:hover{
        background:var(--blue-600);
        color:white;
    }

    .btn-delete:hover{
        background:var(--rose-500);
        color:white;
    }

    .empty-state{
        padding:4rem 1rem;
        text-align:center;
        color:var(--slate-400);
    }

    .empty-state .icon{
        font-size:2.5rem;
        margin-bottom:.8rem;
        opacity:.4;
    }

    @media(max-width:768px){

        .page-wrap{
            padding:1rem;
        }

        .table-responsive{
            overflow-x:auto;
        }

        table{
            min-width:950px;
        }
    }
</style>

<div class="page-wrap">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="page-title">
            <h1>Data Penyakit</h1>
            <p>Kelola data penyakit tanaman cabai</p>
        </div>

        <a href="{{ route('admin.penyakit.create') }}" class="btn-add">
            ➕ Tambah Penyakit
        </a>

    </div>

    {{-- STATISTIK --}}
    <div class="stat-card">

        <div class="stat-icon">
            🦠
        </div>

        <div>
            <div class="stat-label">Total Penyakit</div>
            <div class="stat-number">
                {{ $penyakit->total() }}
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="table-card">

        <div class="table-header">
            <h2>Daftar Penyakit</h2>
        </div>

        <div class="table-responsive">

            <table>

                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Penyakit</th>
                        <th>Deskripsi</th>
                        <th>Gejala Terkait</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($penyakit as $item)

                    <tr>

                        {{-- KODE --}}
                        <td>
                            <span class="kode-badge">
                                {{ $item->kode_penyakit }}
                            </span>
                        </td>

                        {{-- NAMA --}}
                        <td>
                            <div class="nama-penyakit">
                                {{ $item->nama_penyakit }}
                            </div>
                        </td>

                        {{-- DESKRIPSI --}}
                        <td>
                            <div class="desk">
                                {{ $item->deskripsi ?? '-' }}
                            </div>
                        </td>

                        {{-- GEJALA --}}
                        <td>

                            <div class="gejala-wrap">

                                @forelse($item->gejala as $g)

                                    <span class="gejala-badge">
                                        {{ $g->kode_gejala }}
                                    </span>

                                @empty

                                    <span style="color:var(--slate-400); font-size:.8rem;">
                                        Belum ada gejala
                                    </span>

                                @endforelse

                            </div>

                        </td>

                        {{-- AKSI --}}
                        <td>

                            <div class="aksi-wrap">

                                <a href="{{ route('admin.penyakit.edit', $item->id) }}"
                                   class="btn-edit">
                                    ✏️
                                </a>

                                <form action="{{ route('admin.penyakit.destroy', $item->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-delete"
                                            onclick="return confirm('Hapus data penyakit?')">
                                        🗑️
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5">

                            <div class="empty-state">

                                <div class="icon">📂</div>

                                <div>
                                    Belum ada data penyakit
                                </div>

                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
```
