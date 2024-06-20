@extends('layouts.adm-main')

@section('content')
<div class="card">
    <div class="card-header">Tambah Kategori</div>
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="font-weight-bold">KATEGORI</label>
                <select class="form-control @error('kategori') is-invalid @enderror" name="kategori">
                    @foreach ($aKategori as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>

                <!-- error message untuk kategori -->
                @error('kategori')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">DESKRIPSI</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5"
                    placeholder="Masukkan Deskripsi Kategori">{{ old('deskripsi') }}</textarea>

                <!-- error message untuk deskripsi -->
                @error('deskripsi')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-secondary">BACK</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection