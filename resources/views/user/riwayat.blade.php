@extends('layouts.user')

@section('title', 'Riwayat Diagnosa')

@section('content')

<style>

.page-header{
    margin-bottom:24px;
}

.riwayat-page .page-heading{
    font-size:14px;
    font-weight:600;
    color:#1e3a1e;
    margin-bottom:4px;
}

.page-subtitle{
    color:#6c757d;
    margin:0;
}

.history-card{
    background:#fff;
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,.06);
}

.history-header{
    padding:20px 25px;
    border-bottom:1px solid #eef2f5;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.history-title{
    font-size:18px;
    font-weight:600;
    color:#1b4332;
    margin:0;
}

.table-responsive{
    overflow-x:auto;
}

.table-custom{
    margin-bottom:0;
    min-width:720px;
}

.table-custom thead th{
    background:#f8faf9;
    color:#198754;
    font-size:13px;
    font-weight:600;
    border:none;
    padding:14px 18px;
    white-space:nowrap;
}

.table-custom tbody td{
    padding:14px 18px;
    border-color:#f1f3f5;
    vertical-align:middle;
    font-size:14px;
}

.table-custom tbody tr{
    transition:.2s;
}

.table-custom tbody tr:hover{
    background:#fafdfb;
}

.row-number{
    font-weight:700;
    color:#495057;
}

.disease-name{
    font-weight:600;
    color:#212529;
}

.wp-badge{
    display:inline-flex;
    align-items:center;
    padding:6px 12px;
    border-radius:30px;
    background:#e8f7ee;
    color:#198754;
    font-weight:700;
    font-size:13px;
    white-space:nowrap;
}

.date-text{
    color:#6c757d;
    font-size:13px;
    white-space:nowrap;
}

.action-group{
    display:flex;
    align-items:center;
    gap:8px;
    flex-wrap:nowrap;
}

.action-group form{
    display:flex;
    margin:0;
}

.btn-action{
    border-radius:8px;
    width:36px;
    height:36px;
    padding:0;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    border:none;
    transition:.2s ease;
    font-size:16px;
}

.btn-detail{
    background:#198754;
    color:#fff;
}

.btn-detail:hover{
    background:#157347;
    color:#fff;
    transform:translateY(-1px);
}

.btn-pdf{
    background:#dc3545;
    color:#fff;
}

.btn-pdf:hover{
    background:#bb2d3b;
    color:#fff;
    transform:translateY(-1px);
}

.btn-delete{
    border:1px solid #dc3545;
    background:#fff;
    color:#dc3545;
}

.btn-delete:hover{
    background:#dc3545;
    color:#fff;
    transform:translateY(-1px);
}

.empty-state{
    text-align:center;
    padding:70px 20px;
}

.empty-icon{
    width:90px;
    height:90px;
    margin:auto;
    border-radius:50%;
    background:#e8f7ee;
    color:#198754;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:38px;
    margin-bottom:18px;
}

.empty-title{
    font-weight:600;
    color:#212529;
    margin-bottom:8px;
}

.empty-text{
    color:#6c757d;
    margin:0;
}
/* ================= PAGINATION ================= */

.pagination{
    justify-content:center;
    gap:6px;
    flex-wrap:wrap;
}

.pagination .page-item{
    margin:0;
}

.pagination .page-link{
    border:none;
    border-radius:10px;
    min-width:42px;
    height:42px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#198754;
    font-weight:600;
    background:#fff;
    box-shadow:0 2px 8px rgba(0,0,0,.05);
    transition:.2s;
}

.pagination .page-link:hover{
    background:#198754;
    color:#fff;
}

.pagination .page-item.active .page-link{
    background:#198754;
    color:#fff;
    box-shadow:0 4px 12px rgba(25,135,84,.25);
}

.pagination .page-item.disabled .page-link{
    background:#f5f5f5;
    color:#adb5bd;
    box-shadow:none;
}

.pagination .page-link:focus{
    box-shadow:0 0 0 3px rgba(25,135,84,.2);
}

@media (max-width:576px){

    .pagination .page-link{
        min-width:36px;
        height:36px;
        font-size:13px;
    }

}

</style>
<div class="container riwayat-page">

    {{-- HEADER --}}
    <div class="page-header">

        <h2 class="page-heading">
            Riwayat Diagnosa
        </h2>

        <p class="page-subtitle">
            Daftar hasil diagnosa penyakit tanaman cabai yang pernah dilakukan.
        </p>

    </div>

    {{-- FORM TERSEMBUNYI UNTUK HAPUS SATU DATA (diletakkan di luar form utama agar tidak nested) --}}
    @foreach($riwayat as $item)

        <form id="formHapusSatu{{ $item->id }}"
              action="{{ route('user.riwayat.hapus', $item->id) }}"
              method="POST"
              class="d-none"
              onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">

            @csrf
            @method('DELETE')

        </form>

    @endforeach

    {{-- TABLE CARD --}}
    <div class="history-card">

        {{-- SATU FORM UNTUK SELURUH TABEL + TOMBOL HAPUS TERPILIH --}}
        <form id="formHapusTerpilih"
              method="POST"
              action="{{ route('user.riwayat.hapus.semua') }}"
              onsubmit="return confirm('Hapus semua riwayat yang dipilih?')">

            @csrf
            @method('DELETE')

            <div class="history-header">

                <h5 class="history-title">
                    <i class="ti ti-history me-2"></i>
                    Data Riwayat Diagnosa
                </h5>

                <button type="submit"
                        class="btn btn-danger"
                        id="btnDeleteSelected"
                        disabled>

                    <i class="ti ti-trash"></i>
                    Hapus Terpilih

                </button>

            </div>

            <div class="table-responsive">

                <table class="table table-custom align-middle">

                    <thead>
                    <tr>

                        <th width="50">
                            <input type="checkbox" id="selectAll">
                        </th>

                        <th width="60">No</th>
                        <th width="170">Tanggal Diagnosa</th>
                        <th>Penyakit</th>
                        <th width="130">Nilai WP</th>
                        <th width="140">Aksi</th>

                    </tr>
                    </thead>

                    <tbody>

                    @forelse($riwayat as $item)

                        <tr>

                            <td>

                                <input type="checkbox"
                                       class="rowCheckbox"
                                       name="ids[]"
                                       value="{{ $item->id }}">

                            </td>

                            <td>
                                <span class="row-number">
                                    {{ $riwayat->firstItem() + $loop->index }}
                                </span>
                            </td>

                            <td>
                                <span class="date-text">
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </span>
                            </td>

                            <td>
                                <span class="disease-name">
                                    {{ $item->penyakit->nama_penyakit ?? '-' }}
                                </span>
                            </td>

                            <td>

                                <span class="wp-badge">

                                    {{ number_format($item->nilai_hasil,4) }}

                                </span>

                            </td>

                            <td>

                                <div class="action-group">

                                    <a href="{{ route('user.diagnosa.hasil', $item->id) }}"
                                       class="btn btn-sm btn-action btn-detail"
                                       title="Lihat Detail">

                                        <i class="ti ti-eye"></i>

                                    </a>

                                    <a href="{{ route('user.diagnosa.pdf', $item->id) }}"
                                       class="btn btn-sm btn-action btn-pdf"
                                       title="Unduh PDF"
                                       target="_blank">

                                        <i class="ti ti-file-type-pdf"></i>

                                    </a>

                                    <button type="submit"
                                            form="formHapusSatu{{ $item->id }}"
                                            class="btn btn-sm btn-action btn-delete"
                                            title="Hapus Riwayat">

                                        <i class="ti ti-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="ti ti-file-off"></i>
                                    </div>

                                    <h5 class="empty-title">
                                        Belum Ada Riwayat Diagnosa
                                    </h5>

                                    <p class="empty-text">
                                        Riwayat diagnosa akan muncul setelah Anda melakukan proses diagnosa.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </form>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">

        {{ $riwayat->onEachSide(1)->links('pagination::bootstrap-5') }}

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const selectAll  = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.rowCheckbox');
    const deleteBtn  = document.getElementById('btnDeleteSelected');

    function toggleButton() {

        const checkedCount = document.querySelectorAll('.rowCheckbox:checked').length;

        deleteBtn.disabled = (checkedCount === 0);

        if (checkboxes.length > 0) {
            selectAll.checked = (checkedCount === checkboxes.length);
        }

    }

    if (selectAll) {

        selectAll.addEventListener('change', function () {

            checkboxes.forEach(function (cb) {
                cb.checked = selectAll.checked;
            });

            toggleButton();

        });

    }

    checkboxes.forEach(function (cb) {

        cb.addEventListener('change', function () {

            if (!cb.checked) {
                selectAll.checked = false;
            }

            toggleButton();

        });

    });

    toggleButton();

});

</script>

@endsection