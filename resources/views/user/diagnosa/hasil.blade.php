@extends('layouts.user')

@section('content')

<div class="container">

    <h3 class="mb-4">Hasil Diagnosa</h3>

    <div class="card p-4">

        {{-- HASIL UTAMA --}}
        <p>
            <strong>Penyakit:</strong>
            {{ $diagnosa->penyakit->nama_penyakit ?? 'Tidak teridentifikasi' }}
        </p>

        <p>
            <strong>Nilai Preferensi:</strong>
            {{ number_format($diagnosa->nilai_hasil ?? 0, 4) }}
        </p>

        {{-- REKOMENDASI OBAT --}}
        <h5 class="mt-3">Rekomendasi Obat:</h5>

        @if(!empty($diagnosa->penyakit) && $diagnosa->penyakit->obat && $diagnosa->penyakit->obat->count() > 0)

            <ul>
                @foreach($diagnosa->penyakit->obat as $obat)
                    <li>{{ $obat->nama_obat }}</li>
                @endforeach
            </ul>

        @else

            <p>- Tidak ada rekomendasi obat</p>

        @endif

        {{-- GEJALA --}}
        <h5 class="mt-4">Gejala yang Dipilih:</h5>

        @if($diagnosa->gejala && $diagnosa->gejala->count() > 0)

            <ul>
                @foreach($diagnosa->gejala as $g)
                    <li>{{ $g->nama_gejala }}</li>
                @endforeach
            </ul>

        @else

            <p>- Tidak ada gejala tersimpan</p>

        @endif

        <hr>

        {{-- RANKING --}}
        <h5 class="mt-4">Ranking Weighted Product</h5>

        @if(!empty($ranking) && count($ranking) > 0)

            <table class="table table-bordered">

                <thead class="table-success">

                    <tr>
                        <th>Ranking</th>
                        <th>Penyakit</th>
                        <th>Nilai WP</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($ranking as $kode => $r)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r['nama_penyakit'] ?? '-' }}</td>
                            <td>{{ number_format($r['nilai_v'] ?? 0, 4) }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <p class="text-muted">
                Tidak ada data ranking Weighted Product.
            </p>

        @endif

    </div>

</div>

@endsection