@extends('layout.admin-app')

{{-- Menambahkan CSS Kustom untuk Tampilan Modern --}}
@push('styles')
<style>
    .stat-card {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        color: white;
        padding: 25px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .stat-card .inner h3 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-card .inner p {
        font-size: 1.1rem;
        font-weight: 300;
    }

    .stat-card .icon {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        font-size: 80px;
        color: rgba(255, 255, 255, 0.15);
        transition: transform 0.3s ease;
    }

    .stat-card:hover .icon {
        transform: translateY(-50%) scale(1.1);
    }

    .stat-card-footer {
        display: block;
        padding: 8px 0;
        margin-top: 15px;
        background-color: rgba(0, 0, 0, 0.15);
        text-align: center;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .stat-card-footer:hover {
        background-color: rgba(0, 0, 0, 0.3);
        color: white;
    }

    /* Definisi Gradien Warna */
    .bg-gradient-info {
        background: linear-gradient(45deg, #17a2b8, #138496);
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #28a745, #218838);
    }

    .bg-gradient-warning {
        background: linear-gradient(45deg, #ffc107, #e0a800);
        color: #343a40 !important;
    }

    .bg-gradient-warning .stat-card-footer {
        color: rgba(52, 58, 64, 0.8);
    }

    .bg-gradient-warning .stat-card-footer:hover {
        color: #343a40;
    }

    .bg-gradient-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #0069d9);
    }
</style>
@endpush

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Beranda</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{-- Kartu Jumlah Dosen --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card stat-card bg-gradient-success">
                        <div class="inner">
                            <h3>{{ $jumlahDosen }}</h3>
                            <p>Jumlah Dosen</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin-dosen') }}" class="stat-card-footer">Lihat Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Kartu Jumlah Tenaga Kependidikan --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card stat-card bg-gradient-warning">
                        <div class="inner">
                            <h3>{{ $jumlahTendik }}</h3>
                            <p>Tenaga Kependidikan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="{{ route('admin-tenaga-kependidikan') }}" class="stat-card-footer">Lihat Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Kartu Jumlah Prodi --}}
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="card stat-card bg-gradient-danger">
                        <div class="inner">
                            <h3>{{ $jumlahProdi }}</h3>
                            <p>Jumlah Program Studi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <a href="{{ route('admin-program-studi') }}" class="stat-card-footer">Lihat Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Kartu Jumlah Berita --}}
                <div class="col-lg-6 col-md-6 col-12 mb-4">
                    <div class="card stat-card bg-gradient-info">
                        <div class="inner">
                            <h3>{{ $jumlahBerita }}</h3>
                            <p>Jumlah Berita</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <a href="{{ route('admin-berita') }}" class="stat-card-footer">Lihat Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Kartu Jumlah HKI --}}
                <div class="col-lg-6 col-md-6 col-12 mb-4">
                    <div class="card stat-card bg-gradient-primary">
                        <div class="inner">
                            <h3>{{ $jumlahHki }}</h3>
                            <p>Jumlah HKI</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <a href="{{ route('admin-hki') }}" class="stat-card-footer">Lihat Detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection