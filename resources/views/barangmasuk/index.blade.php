@extends('layouts.adm-main')

@section('content')
<div class="card-body">
    <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG MASUK</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('Gagal'))
        <div class="alert alert-danger">
            {{ session('Gagal') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Jumlah Masuk</th>
                    <th scope="col">Stok Barang</th>
                    <th scope="col">Merk</th>
                    <th scope="col" style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangmasuk as $bm)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ formatTanggal($bm->tgl_masuk) }}</td>
                        <td>{{ $bm->qty_masuk }}</td>
                        <td>{{ $bm->barang->stok }}</td>
                        <td>{{ $bm->barang->merk }}</td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');"
                                action="{{ route('barangmasuk.destroy', $bm->id) }}" method="POST" style="display:inline">
                                <a href="{{ route('barangmasuk.show', $bm->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                <a href="{{ route('barangmasuk.edit', $bm->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="alert alert-danger">
                                Data Barang belum Tersedia.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $barangmasuk->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection

@php
function formatTanggal($tanggal)
{
    $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $tgl = strtotime($tanggal);
    $namaHari = $hari[date('w', $tgl)];
    $namaBulan = $bulan[date('n', $tgl) - 1];
    $tanggalFormatted = sprintf('%s, %d %s %d', $namaHari, date('j', $tgl), $namaBulan, date('Y', $tgl));

    return $tanggalFormatted;
}
@endphp
