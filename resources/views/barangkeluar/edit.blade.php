@extends('layouts.adm-main')

@section('content')
<div class="card">
    <div class="card-header">Edit Barang Keluar</div>
    <div class="card-body">
        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="font-weight-bold">Tanggal Keluar</label>
                <input type="date" name="tgl_keluar" class="form-control @error('tgl_keluar') is-invalid @enderror"
                    value="{{ old('tgl_keluar', $barangkeluar->tgl_keluar) }}" placeholder="Masukkan Tanggal" required>
                @error('tgl_keluar')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Jumlah Keluar</label>
                <input type="number" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror"
                    value="{{ old('qty_keluar', $barangkeluar->qty_keluar) }}" placeholder="Masukkan Jumlah" required
                    min="1">
                @error('qty_keluar')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Merk Barang</label>
                <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                    <option value="" selected disabled>Pilih Merk Barang</option>
                    @foreach ($merkBarang as $id => $merk)
                        <option value="{{ $id }}" {{ $id == $barangkeluar->barang_id ? 'selected' : '' }}>{{ $merk }}</option>
                    @endforeach
                </select>
                @error('barang_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary me-3">UPDATE</button>
            <button type="reset" class="btn btn-warning">RESET</button>
            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">KEMBALI</a>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection