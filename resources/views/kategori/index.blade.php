@extends('layouts.adm-main')

@section('content')
<form action="{{ route('kategori.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Search...">
                        <button class="btn btn-secondary" type="submit">Search</button>
                    </div>
                </form>


<div class="card-body">
    <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Kategori</th>
                <th scope="col">Keterangan Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col" style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rsetKategori as $kategori)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->kategori }}</td>
                    <td>{{ $kategori->ketKategorik }}</td>
                    <td>{{ $kategori->deskripsi }}</td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                            <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <div class="alert alert-danger">
                    Data Kategori belum Tersedia.
                </div>
            @endforelse
        </tbody>
    </table>
    {{ $rsetKategori->links() }}
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    //message with sweetalert
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