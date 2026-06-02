@extends('layouts.user')

@section('title','Diagnosa Penyakit')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-9">

        <div class="card shadow-sm border-0 p-4">

            <div class="mb-4">

                <h4 class="fw-bold mb-1">
                    Diagnosa Penyakit Tanaman Cabai
                </h4>

                <p class="text-muted mb-0" style="font-size:14px">
                    Pilih gejala yang ditemukan pada tanaman cabai untuk melakukan proses diagnosa menggunakan metode Rule-Based dan Weighted Product.
                </p>

            </div>
            <form action="{{ route('user.diagnosa.proses') }}" method="POST">

                @csrf

                @error('gejala')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror

                <div class="table-responsive">

                    <table class="table table-bordered align-middle">

                        <thead class="table-success">

                            <tr class="text-center">

                                <th width="10%">Pilih</th>
                                <th width="20%">Kode Gejala</th>
                                <th>Nama Gejala</th>

                            </tr>

                        </thead>

                        <tbody>

<tr id="row-1">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G01"
               class="form-check-input gejala-check"
               id="gejala-1"
               onchange="toggleRow(1)">
    </td>
    <td class="text-center fw-semibold">G01</td>
    <td>Daun menguning</td>
</tr>

<tr id="row-2">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G02"
               class="form-check-input gejala-check"
               id="gejala-2"
               onchange="toggleRow(2)">
    </td>
    <td class="text-center fw-semibold">G02</td>
    <td>Bercak hitam pada daun</td>
</tr>

<tr id="row-3">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G03"
               class="form-check-input gejala-check"
               id="gejala-3"
               onchange="toggleRow(3)">
    </td>
    <td class="text-center fw-semibold">G03</td>
    <td>Batang membusuk</td>
</tr>

<tr id="row-4">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G04"
               class="form-check-input gejala-check"
               id="gejala-4"
               onchange="toggleRow(4)">
    </td>
    <td class="text-center fw-semibold">G04</td>
    <td>Buah keriput</td>
</tr>

<tr id="row-5">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G05"
               class="form-check-input gejala-check"
               id="gejala-5"
               onchange="toggleRow(5)">
    </td>
    <td class="text-center fw-semibold">G05</td>
    <td>Daun menggulung</td>
</tr>

<tr id="row-6">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G06"
               class="form-check-input gejala-check"
               id="gejala-6"
               onchange="toggleRow(6)">
    </td>
    <td class="text-center fw-semibold">G06</td>
    <td>Pertumbuhan lambat</td>
</tr>

<tr id="row-7">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G07"
               class="form-check-input gejala-check"
               id="gejala-7"
               onchange="toggleRow(7)">
    </td>
    <td class="text-center fw-semibold">G07</td>
    <td>Akar busuk/berjamur</td>
</tr>

<tr id="row-8">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G08"
               class="form-check-input gejala-check"
               id="gejala-8"
               onchange="toggleRow(8)">
    </td>
    <td class="text-center fw-semibold">G08</td>
    <td>Jamur pada pangkal batang</td>
</tr>

<tr id="row-9">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G09"
               class="form-check-input gejala-check"
               id="gejala-9"
               onchange="toggleRow(9)">
    </td>
    <td class="text-center fw-semibold">G09</td>
    <td>Buah cabai busuk basah</td>
</tr>

<tr id="row-10">
    <td class="text-center">
        <input type="checkbox"
               name="gejala[]"
               value="G10"
               class="form-check-input gejala-check"
               id="gejala-10"
               onchange="toggleRow(10)">
    </td>
    <td class="text-center fw-semibold">G10</td>
    <td>Bercak coklat pada buah</td>
</tr>

</tbody>

                    </table>

                </div>

                <div class="mt-4 d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success px-4">

                        Proses Diagnosa

                    </button>

                    <button
                        type="reset"
                        class="btn btn-outline-secondary"
                        onclick="resetAll()">

                        Reset

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

function toggleRow(id)
{
    const chk = document.getElementById('gejala-'+id);
    const row = document.getElementById('row-'+id);

    row.style.background = chk.checked ? '#f0fff4' : '#ffffff';
}

function resetAll()
{
    document.querySelectorAll('.gejala-check').forEach(c => {
        c.checked = false;
    });

    document.querySelectorAll('tr[id^="row-"]').forEach(row => {
        row.style.background = '#ffffff';
    });
}

</script>

@endsection