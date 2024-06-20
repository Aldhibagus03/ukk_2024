@extends('layouts.adm-main')

@section('content')
<form action="{{ route('barang.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </form>


<div class="card-body">
    <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG</a>

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
                    <th scope="col">Merk</th>
                    <th scope="col">Seri</th>
                    <th scope="col">Spesifikasi</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kategori</th>
                    <th scope="col" style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rsetBarang as $barang)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->seri }}</td>
                        <td>{{ $barang->spesifikasi }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ $barang->kategori->deskripsi }}</td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');"
                                action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline">
                                <a href="{{ route('barang.show', $barang->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
        {{ $rsetBarang->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Message with SweetAlert
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
