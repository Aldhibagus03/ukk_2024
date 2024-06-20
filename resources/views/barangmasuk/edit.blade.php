@extends('layouts.adm-main')

@section('content')
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('barangmasuk.update', $barangmasuk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label class="font-weight-bold">TANGGAL MASUK</label>
                    <input type="date" name="tgl_masuk" class="form-control @error('tgl_masuk') is-invalid @enderror"
                        value="{{ old('tgl_masuk', $barangmasuk->tgl_masuk) }}" placeholder="Masukkan Tanggal" required>
                    @error('tgl_masuk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">JUMLAH MASUK</label>
                    <input type="number" name="qty_masuk" class="form-control @error('qty_masuk') is-invalid @enderror"
                        value="{{ old('qty_masuk', $barangmasuk->qty_masuk) }}" placeholder="Masukkan Jumlah" required>
                    @error('qty_masuk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">MERK BARANG</label>
                    <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                        <option value="" selected disabled>Pilih Merk Barang</option>
                        @foreach ($merkBarang as $id => $merk)
                            <option value="{{ $id }}" {{ $id == $barangmasuk->barang_id ? 'selected' : '' }}>{{ $merk }}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Tambahkan input atau select lainnya sesuai kebutuhan -->
                <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-primary">KEMBALI</a>
            </form>
        </div>
    </div>
@endsection
