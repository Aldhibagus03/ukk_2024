@extends('layouts.adm-main')

@section('content')
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label class="font-weight-bold">MERK</label>
                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ $barang->merk }}" placeholder="Masukkan Merk Barang" required>
                    @error('merk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label class="font-weight-bold">SERI</label>
                    <input type="text" name="seri" class="form-control @error('seri') is-invalid @enderror" value="{{ $barang->seri }}" placeholder="Masukkan Seri Barang" required>
                    @error('seri')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label class="font-weight-bold">SPESIFIKASI</label>
                    <textarea name="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror" rows="5" placeholder="Masukkan Spesifikasi Barang" required>{{ $barang->spesifikasi }}</textarea>
                    @error('spesifikasi')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group mb-3">
                    <label class="font-weight-bold">KATEGORI</label>
                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}" @if ($barang->kategori_id == $k->id) selected @endif>{{ $k->deskripsi }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">KEMBALI</a>
            </form>
        </div>
    </div>
@endsection
