@extends('layouts.user')

@section('title','Hasil Diagnosa')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">


<style>

.nilai-v{

    display:inline-block;
    padding:.25rem .6rem;

    background:#eff6ff;
    color:#2563eb;

    border-radius:20px;

    font-weight:700;
    font-size:.75rem;

}

.persen{

    display:inline-block;
    padding:.25rem .6rem;

    background:#ecfdf5;
    color:#059669;

    border-radius:20px;

    font-weight:700;
    font-size:.75rem;

}

.user-wrap *{
    font-family:'Plus Jakarta Sans',sans-serif;
    box-sizing:border-box;
}


.user-wrap{
    background:#f1f5f9;
    min-height:100vh;
    padding:2rem;
}


/* HEADER */

.page-head{
    margin-bottom:1.5rem;
}

.page-head h4{
    margin:0;
    font-size:1.25rem;
    font-weight:800;
    color:#0f172a;
}

.page-head p{
    margin:.3rem 0;
    color:#64748b;
    font-size:.85rem;
}



/* RESULT */

.result-banner{

    background:#ecfdf5;
    border:1px solid #d1fae5;
    border-radius:16px;
    padding:1.5rem;

    display:flex;
    align-items:center;
    gap:1rem;

    margin-bottom:1.5rem;
}


.result-icon{

    width:52px;
    height:52px;
    border-radius:14px;

    background:#10b981;
    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;
}


.result-label{

    font-size:.7rem;
    font-weight:700;
    color:#059669;

    text-transform:uppercase;

}


.result-name{

    font-size:1.3rem;
    font-weight:800;
    color:#0f172a;

}


.nilai-chip{

    margin-left:auto;

    background:#eff6ff;
    color:#2563eb;

    border:1px solid #dbeafe;

    padding:.35rem .9rem;

    border-radius:20px;

    font-size:.8rem;
    font-weight:700;

}




/* GRID */

.detail-grid{

    display:grid;

    grid-template-columns:1fr 330px;

    gap:1.5rem;

}


@media(max-width:900px){

.detail-grid{

grid-template-columns:1fr;

}

}




/* CARD */

.card{

background:white;

border:1px solid #e2e8f0;

border-radius:16px;

box-shadow:0 2px 8px rgba(0,0,0,.05);

overflow:hidden;

margin-bottom:1.5rem;

}



.card-head{

padding:1rem 1.3rem;

border-bottom:1px solid #f1f5f9;

font-size:.9rem;

font-weight:700;

color:#1e293b;

}


.card-body{

padding:1.3rem;

}




/* TABLE */


.table{

width:100%;

border-collapse:collapse;

font-size:.85rem;

}


.table th{

background:#f8fafc;

color:#94a3b8;

font-size:.7rem;

padding:.8rem;

text-align:left;

}


.table td{

padding:.85rem;

border-bottom:1px solid #f1f5f9;

}


.kode{

background:#eff6ff;

color:#2563eb;

padding:.25rem .5rem;

border-radius:6px;

font-size:.75rem;

font-weight:700;

}


.bobot{

background:#fffbeb;

color:#d97706;

border-radius:20px;

padding:.25rem .6rem;

font-size:.75rem;

font-weight:700;

}



/* META */

.meta{

display:flex;

justify-content:space-between;

padding:.7rem 0;

border-bottom:1px solid #f1f5f9;

font-size:.85rem;

}


.meta:last-child{

border:none;

}


.meta span:first-child{

color:#94a3b8;

}


.meta span:last-child{

font-weight:700;

color:#334155;

}




/* OBAT */

.obat{

display:flex;

gap:.7rem;

padding:.7rem 0;

border-bottom:1px solid #f1f5f9;

}


.obat:last-child{

border:none;

}


.dot{

width:8px;

height:8px;

background:#10b981;

border-radius:50%;

margin-top:6px;

}


.obat-name{

font-weight:700;

color:#1e293b;

font-size:.85rem;

}



/* RANKING */


.rank-item{

display:flex;

justify-content:space-between;

padding:.7rem;

border-bottom:1px solid #f1f5f9;

font-size:.85rem;

}


.rank-item:first-child{

background:#ecfdf5;

}


.rank-score{

background:#eff6ff;

padding:.25rem .6rem;

border-radius:8px;

font-weight:700;

color:#2563eb;

}

.obat{
    display:flex;
    align-items:flex-start;
    gap:.75rem;
    padding:.85rem 0;
    border-bottom:1px solid #f1f5f9;
}


.obat:last-child{
    border-bottom:none;
}


.dot{
    width:9px;
    height:9px;
    background:#10b981;
    border-radius:50%;
    margin-top:6px;
    flex-shrink:0;
}


.obat-content{
    flex:1;
}


.obat-name{
    font-size:.875rem;
    font-weight:700;
    color:#1e293b;
}


.obat-desc{

    margin-top:.2rem;

    font-size:.78rem;

    line-height:1.5;

    color:#64748b;

}

.penyakit-desc{

    margin:0;

    font-size:.875rem;

    color:#64748b;

    line-height:1.7;

}

</style>




<div class="user-wrap">


<div class="page-head">

<h4>Hasil Diagnosa</h4>

<p>Hasil identifikasi penyakit berdasarkan gejala yang dipilih</p>

</div>




{{-- HASIL --}}

<div class="result-banner">


<div class="result-icon">

<i class="bi bi-shield-check"></i>

</div>


<div style="flex:1">

    <div class="result-label">
        Penyakit Terdeteksi
    </div>


    <div class="result-name">
        {{ $diagnosa->penyakit?->nama_penyakit ?? 'Tidak Teridentifikasi' }}
    </div>


    @if($diagnosa->penyakit?->deskripsi)

    <div class="result-kode">
        {{ $diagnosa->penyakit->deskripsi }}
    </div>

    @endif


</div>


<div class="nilai-chip">

<i class="bi bi-bar-chart"></i>

Nilai Preferensi :

{{number_format($diagnosa->nilai_hasil ?? 0,4)}}

</div>


</div>





<div class="detail-grid">


{{-- KIRI --}}

<div>



<div class="card">


<div class="card-head">

<i class="bi bi-list-check"></i>

Gejala yang Dipilih

</div>



<table class="table">


<thead>

<tr>

<th>No</th>

<th>Kode</th>

<th>Gejala</th>

<th>Bobot</th>

</tr>

</thead>


<tbody>


@forelse($diagnosa->gejala as $i=>$g)

<tr>

<td>{{$i+1}}</td>


<td>

<span class="kode">

{{$g->kode_gejala}}

</span>

</td>


<td>

{{$g->nama_gejala}}

</td>


<td>

<span class="bobot">

{{ number_format($g->bobot, 4) }}

</span>

</td>


</tr>


@empty

<tr>

<td colspan="4">

Tidak ada data gejala

</td>

</tr>


@endforelse


</tbody>

</table>


</div>






@if(count($ranking) > 1)

<div class="card">

    <div class="card-head">
        <i class="bi bi-trophy"></i>
        Ranking Weighted Product
    </div>

    <table class="table">

        <thead>
            <tr>
                <th>No</th>
                <th>Penyakit</th>
                <th>Nilai V</th>
                <th>Persentase</th>
            </tr>
        </thead>


        <tbody>

        @foreach($ranking as $i=>$r)

        <tr>

            <td>{{ $i+1 }}</td>


            <td>

                @if($i==0)
                <i class="bi bi-trophy-fill text-warning"></i>
                @endif

                {{ $r['nama_penyakit'] }}

            </td>


            <td>

                <span class="nilai-v">

                {{ number_format($r['nilai_v'],4) }}

                </span>

            </td>


            <td>

                <span class="persen">

                {{ number_format($r['nilai_v']*100,2) }}%

                </span>

            </td>


        </tr>

        @endforeach


        </tbody>

    </table>

</div>

@else

<div class="card">

    <div class="card-head">
        <i class="bi bi-check-circle"></i>
        Hasil Rule-Based
    </div>


    <div class="card-body">

        <p style="
            color:#64748b;
            font-size:.875rem;
            margin-bottom:.5rem;
        ">
            Berdasarkan aturan gejala yang dipilih, sistem menemukan satu kandidat penyakit.
        </p>


        <div class="meta">

            <span>Penyakit</span>

            <span>
                {{ $diagnosa->penyakit->nama_penyakit }}
            </span>

        </div>


        <div class="meta">

            <span>Nilai Preferensi</span>

            <span>
                {{ number_format($diagnosa->nilai_hasil,4) }}
                ({{ number_format($diagnosa->nilai_hasil*100,2) }}%)
            </span>

        </div>


    </div>

</div>

@endif

</div>

</div>





{{-- KANAN --}}


<div>


<div class="card">


<div class="card-head">

<i class="bi bi-info-circle"></i>

Ringkasan

</div>



<div class="card-body">


<div class="meta">

<span>Metode</span>

<span>Rule-Based + WP</span>

</div>



<div class="meta">

<span>Jumlah Gejala</span>

<span>{{$diagnosa->gejala->count()}}</span>

</div>



<div class="meta">

<span>Keterangan</span>

<span>{{$diagnosa->keterangan}}</span>

</div>



</div>


</div>





{{-- REKOMENDASI OBAT --}}
<div class="card">

    <div class="card-head">
        <i class="bi bi-capsule"></i>
        Rekomendasi Penanganan
    </div>


    <div class="card-body">

        @if($diagnosa->penyakit?->obat?->count())

            @foreach($diagnosa->penyakit->obat as $obat)

                <div class="obat">

                    <div class="dot"></div>

                    <div class="obat-content">

                        <div class="obat-name">
                            {{ $obat->nama_obat }}
                        </div>


                        @if($obat->keterangan)

                            <div class="obat-desc">
                                {{ $obat->keterangan }}
                            </div>

                        @endif

                    </div>

                </div>

            @endforeach


        @else

            <div style="
                color:#94a3b8;
                font-size:.85rem;
                text-align:center;
            ">
                Tidak ada rekomendasi obat.
            </div>


        @endif


    </div>

</div>

<a href="{{ url('/user/diagnosa') }}" class="btn btn-outline-success w-100">

<i class="bi bi-arrow-repeat"></i>

Diagnosa Kembali

</a>



</div>


</div>


</div>


@endsection

@if(session('error'))

<div class="alert alert-warning">
    {{ session('error') }}
</div>

@endif
