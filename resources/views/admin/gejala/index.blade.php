@extends('layouts.admin')
@section('title', 'Manajemen Gejala')
@section('page-title', 'Kelola Data Gejala')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<style>
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
        --rose-50:   #fff1f2;
        --rose-500:  #f43f5e;
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
        --white:     #ffffff;
        --radius-sm: 10px;
        --radius:    16px;
        --radius-lg: 20px;
        --shadow-sm: 0 1px 2px rgba(15,23,42,.04), 0 2px 8px rgba(15,23,42,.06);
        --shadow-md: 0 4px 8px rgba(15,23,42,.06), 0 16px 40px rgba(15,23,42,.10);
        --transition: .22s cubic-bezier(.4,0,.2,1);
    }

    .db-wrap * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
    .db-wrap   { background: var(--slate-100); min-height: 100vh; padding: 2.25rem 2rem 4rem; }

    .db-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.25rem; flex-wrap: wrap; gap: 1rem; }
    .db-header-left h1 { font-size: 1.625rem; font-weight: 800; color: var(--slate-900); letter-spacing: -.4px; margin: 0 0 .2rem; }
    .db-header-left p  { font-size: .825rem; color: var(--slate-400); margin: 0; font-weight: 500; }

    .btn-primary   { display: inline-flex; align-items: center; gap: .5rem; font-size: .85rem; font-weight: 600; color: var(--white); background: var(--blue-600); border: 1px solid var(--blue-600); border-radius: var(--radius-sm); padding: .6rem 1.2rem; text-decoration: none; cursor: pointer; transition: all var(--transition); box-shadow: var(--shadow-sm); font-family: inherit; }
    .btn-primary:hover { background: var(--blue-700); border-color: var(--blue-700); transform: translateY(-1px); }
    .btn-secondary { background: var(--white); color: var(--slate-600); border: 1px solid var(--slate-200); padding: .6rem 1.2rem; border-radius: var(--radius-sm); font-size: .85rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: all var(--transition); }
    .btn-secondary:hover { background: var(--slate-50); }

    .main-card        { background: var(--white); border-radius: var(--radius); border: 1px solid var(--slate-200); box-shadow: var(--shadow-sm); overflow: hidden; }
    .table-responsive { width: 100%; overflow-x: auto; }
    .h-table          { width: 100%; border-collapse: collapse; font-size: .86rem; }
    .h-table thead th { background: var(--slate-50); color: var(--slate-400); font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .65px; padding: .9rem 1.75rem; text-align: left; border-bottom: 1px solid var(--slate-100); }
    .h-table tbody tr { border-bottom: 1px solid var(--slate-100); transition: background var(--transition); }
    .h-table tbody tr:hover { background: var(--slate-50); }
    .h-table td       { padding: 1.1rem 1.75rem; color: var(--slate-700); vertical-align: middle; line-height: 1.5; }

    .td-no   { font-weight: 700; color: var(--slate-400); font-size: .8rem; }
    .td-code { font-weight: 700; color: var(--blue-600); background: var(--blue-50); padding: .2rem .5rem; border-radius: 6px; font-size: .78rem; }
    .td-name { font-weight: 600; color: var(--slate-800); }
    .bobot-badge { display: inline-block; background: var(--emerald-50); color: var(--emerald-600); border: 1px solid #d1fae5; font-size: .78rem; font-weight: 700; padding: .2rem .65rem; border-radius: 999px; }

    .action-group { display: flex; gap: .5rem; justify-content: center; }
    .btn-action   { width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid transparent; cursor: pointer; transition: all var(--transition); background: none; font-size: .85rem; }
    .btn-edit     { background: var(--amber-50); color: var(--amber-600); border-color: var(--amber-50); }
    .btn-edit:hover   { background: var(--amber-500); color: var(--white); }
    .btn-delete   { background: var(--rose-50); color: var(--rose-500); border-color: var(--rose-50); }
    .btn-delete:hover { background: var(--rose-500); color: var(--white); }

    .alert-toast { background: var(--emerald-50); border-left: 4px solid var(--emerald-500); color: var(--emerald-600); padding: 1rem 1.25rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; font-size: .85rem; font-weight: 600; }

    .custom-modal { position: fixed; inset: 0; background: rgba(15,23,42,.4); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 99999; padding: 1rem; }
    .custom-modal.active { display: flex; }
    .modal-content { background: var(--white); border-radius: var(--radius-lg); border: 1px solid var(--slate-200); box-shadow: var(--shadow-md); width: 100%; max-width: 480px; overflow: hidden; animation: modalFadeIn .2s ease-out; }
    @keyframes modalFadeIn { from { transform: scale(.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    .modal-header  { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--slate-100); display: flex; align-items: center; justify-content: space-between; }
    .modal-header h3 { margin: 0; font-size: 1.05rem; font-weight: 700; color: var(--slate-900); }
    .modal-close   { background: none; border: none; font-size: 1.5rem; color: var(--slate-400); cursor: pointer; line-height: 1; }
    .modal-body    { padding: 1.5rem; display: flex; flex-direction: column; gap: 1.1rem; }
    .modal-footer  { padding: 1rem 1.5rem; background: var(--slate-50); border-top: 1px solid var(--slate-100); display: flex; justify-content: flex-end; gap: .75rem; }

    .form-group label { display: block; font-size: .78rem; font-weight: 700; color: var(--slate-600); text-transform: uppercase; letter-spacing: .5px; margin-bottom: .4rem; }
    .form-control { width: 100%; padding: .65rem .85rem; font-size: .875rem; border: 1px solid var(--slate-200); border-radius: var(--radius-sm); background: var(--white); color: var(--slate-800); outline: none; font-family: inherit; }
    .form-control:focus { border-color: var(--blue-500); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }
    .form-hint { font-size: .73rem; color: var(--slate-400); margin-top: .3rem; }

    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
</style>

<div class="db-wrap">

    {{-- HEADER --}}
    <div class="db-header">
        <div class="db-header-left">
            <h1>Manajemen Gejala</h1>
            <p>Daftar kriteria gejala dan bobot Weighted Product</p>
        </div>
        <button type="button" class="btn-primary" onclick="bukaModalTambah()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Gejala
        </button>
    </div>

    @if(session('success'))
        <div class="alert-toast">✨ {{ session('success') }}</div>
    @endif

    {{-- TABLE --}}
    <div class="main-card">
        <div class="table-responsive">
            <table class="h-table">
                <thead>
                    <tr>
                        <th style="width:55px;">No</th>
                        <th style="width:130px;">Kode</th>
                        <th>Nama Gejala</th>
                        <th style="width:120px; text-align:center;">Bobot (W)</th>
                        <th style="width:100px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allGejala as $g)
                        <tr>
                            <td class="td-no">{{ $loop->iteration }}</td>
                            <td><span class="td-code">{{ $g->kode_gejala }}</span></td>
                            <td class="td-name">{{ $g->nama_gejala }}</td>
                            <td style="text-align:center;">
                                <span class="bobot-badge">{{ number_format($g->bobot, 4) }}</span>
                            </td>
                            <td>
                                <div class="action-group">
                                    <button type="button" class="btn-action btn-edit" title="Edit"
                                        onclick="bukaModalEdit('{{ $g->id }}', '{{ addslashes($g->kode_gejala) }}', '{{ addslashes($g->nama_gejala) }}', '{{ $g->bobot }}')">
                                        ✏️
                                    </button>
                                    <form action="{{ route('admin.gejala.destroy', $g->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus gejala ini? Rule terkait akan terpengaruh.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; color:var(--slate-400); padding:2.5rem 0; font-size:.875rem;">
                                Belum ada data gejala.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- MODAL --}}
<div class="custom-modal" id="formModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Gejala Baru</h3>
            <button type="button" class="modal-close" onclick="tutupModal()">&times;</button>
        </div>
        <form id="gejalaForm" method="POST" action="{{ route('admin.gejala.store') }}">
            @csrf
            <div id="formMethodContainer"></div>
            <div class="modal-body">
                <div class="two-col">
                    <div class="form-group">
                        <label for="kode_gejala">Kode Gejala</label>
                        <input type="text" name="kode_gejala" id="kode_gejala" class="form-control"
                               placeholder="Contoh: G11" style="text-transform:uppercase;" required>
                    </div>
<div class="form-group">
    <label for="bobot">Bobot (0 – 1)</label>
    <input type="number" name="bobot" id="bobot" class="form-control"
           step="0.0001" min="0" max="1" placeholder="Contoh: 0.1739" required>
    <div class="form-hint">Masukkan bobot normalisasi (4 angka di belakang koma).</div>
</div>
                </div>
                <div class="form-group">
                    <label for="nama_gejala">Nama Gejala</label>
                    <input type="text" name="nama_gejala" id="nama_gejala" class="form-control"
                           placeholder="Masukkan detail gejala tanaman..." required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="tutupModal()">Batal</button>
                <button type="submit" class="btn-primary" style="border-radius:var(--radius-sm)">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    var elModal  = document.getElementById('formModal');
    var elForm   = document.getElementById('gejalaForm');
    var elTitle  = document.getElementById('modalTitle');
    var elMethod = document.getElementById('formMethodContainer');
    var urlStore = "{{ route('admin.gejala.store') }}";

    function bukaModalTambah() {
        elForm.reset();
        elTitle.textContent = 'Tambah Gejala Baru';
        elForm.action = urlStore;
        elMethod.innerHTML = '';
        elModal.classList.add('active');
    }

    function bukaModalEdit(id, kode, nama, bobot) {
        elForm.reset();
        elTitle.textContent = 'Edit Gejala';
        elForm.action = '/admin/gejala/' + id;
        elMethod.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('kode_gejala').value = kode;
        document.getElementById('nama_gejala').value = nama;
        document.getElementById('bobot').value       = bobot;
        elModal.classList.add('active');
    }

    function tutupModal() {
        elModal.classList.remove('active');
        elForm.reset();
    }

    window.addEventListener('click', function(e) {
        if (e.target === elModal) tutupModal();
    });
</script>

@endsection