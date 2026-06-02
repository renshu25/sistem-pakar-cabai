@extends('layouts.user')

@section('title', 'Riwayat Diagnosa')

@section('content')

<div class="container">

    <h4 class="mb-4">Riwayat Diagnosa</h4>

    <div class="card p-4">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Penyakit</th>
                    <th>Nilai WP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($riwayat as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $item->created_at->format('d-m-Y H:i') }}
                    </td>

                    <td>
                        {{ $item->penyakit->nama_penyakit ?? '-' }}
                    </td>

                    <td>
                        {{ number_format($item->nilai_hasil, 4) }}
                    </td>

                    <td class="d-flex gap-1">

    <a href="{{ route('user.diagnosa.hasil', $item->id) }}"
       class="btn btn-sm btn-success">

        Detail

    </a>

    <a href="{{ route('user.diagnosa.pdf', $item->id) }}"
       class="btn btn-sm btn-danger">

        PDF

    </a>

    <form action="{{ route('user.riwayat.hapus', $item->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-sm btn-outline-danger">

            Hapus

        </button>

    </form>

</td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada riwayat diagnosa
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">
            {{ $riwayat->links() }}
        </div>

    </div>

</div>

@endsection