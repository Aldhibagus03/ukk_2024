@extends('layouts.adm-main')

@section('content')
<div class="card-body">
    <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG KELUAR</a>

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
                    <th scope="col">Tanggal Keluar</th>
                    <th scope="col">Jumlah Keluar</th>
                    <th scope="col">Stok Barang</th>
                    <th scope="col">Merk</th>
                    <th scope="col" style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangkeluar as $bk)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ formatTanggal($bk->tgl_keluar) }}</td>
                        <td>{{ $bk->qty_keluar }}</td>
                        <td>{{ $bk->barang->stok }}</td>
                        <td>{{ $bk->barang->merk }}</td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');"
                                action="{{ route('barangkeluar.destroy', $bk->id) }}" method="POST" style="display:inline">
                                <a href="{{ route('barangkeluar.show', $bk->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                <a href="{{ route('barangkeluar.edit', $bk->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="alert alert-danger">
                                Data Barang Keluar belum Tersedia.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $barangkeluar->links() }}
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
