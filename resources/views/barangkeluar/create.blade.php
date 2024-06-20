@extends('layouts.adm-main')

@section('content')
<div class="card">
    <div class="card-header">Tambah Barang Keluar</div>
    <div class="card-body">
        <form action="{{ route('barangkeluar.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label class="font-weight-bold">Tanggal Keluar</label>
                <input type="date" name="tgl_keluar" class="form-control @error('tgl_keluar') is-invalid @enderror" 
                    value="{{ old('tgl_keluar') }}" placeholder="Masukkan Tanggal" required>
                @error('tgl_keluar')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Jumlah Keluar</label>
                <input type="number" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror" 
                    value="{{ old('qty_keluar') }}" placeholder="Masukkan Jumlah" required min="1">
                @error('qty_keluar')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Barang</label>
                <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                    <option value="" selected disabled>Pilih Barang</option>
                    @foreach ($merkBarang as $id => $merk)
                        <option value="{{ $id }}" {{ old('barang_id') == $id ? 'selected' : '' }}>{{ $merk }}</option>
                    @endforeach
                </select>
                @error('barang_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary me-3">Simpan</button>
            <button type="reset" class="btn btn-warning">Reset</button>
            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
