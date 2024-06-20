@extends('layouts.adm-main')

@section('content')
    <section class="hero py-5">
        <div class="container text-center">
            <h1 class="font-weight-bold">SISTEM INFORMASI BARANG</h1>
            <p>Selamat Datang di Sistem Inventory. Silahkan Pilih Menu Dibawah!</p>
        </div>
    </section>

    <section id="features" class="features py-3">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-lg rounded-lg text-center h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="icon mb-3">
                                <i class="fas fa-tags fa-2x"></i>
                            </div>
                            <h4 class="font-weight-bold">Kategori</h4>
                            <p class="flex-grow-1">Manage categories</p>
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Kategori</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-lg rounded-lg text-center h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="icon mb-3">
                                <i class="fas fa-box fa-2x"></i>
                            </div>
                            <h4 class="font-weight-bold">Barang</h4>
                            <p class="flex-grow-1">Manage items</p>
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-lg rounded-lg text-center h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="icon mb-3">
                                <i class="fas fa-arrow-down fa-2x"></i>
                            </div>
                            <h4 class="font-weight-bold">Barang Masuk</h4>
                            <p class="flex-grow-1">Track incoming items</p>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang Masuk</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-lg rounded-lg text-center h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="icon mb-3">
                                <i class="fas fa-arrow-up fa-2x"></i>
                            </div>
                            <h4 class="font-weight-bold">Barang Keluar</h4>
                            <p class="flex-grow-1">Track outgoing items</p>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Load Font Awesome or Bootstrap Icons in your layout -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endsection

<style>
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s;
    }

    .card .icon {
        color: #007bff;
    }

    .card .icon i {
        transition: color 0.3s;
    }

    .card:hover .icon i {
        color: #0056b3;
    }

    .hero {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .features {
        background: #ffffff;
    }
</style>
