@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data HKI</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Data HKI: {{ $hki->judul_hki }}</h3>
                </div>
                {{-- Form action mengarah ke route update dengan ID HKI --}}
                <form action="{{ route('admin-hki.update', $hki->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- Method spoofing untuk request PUT --}}
                    <div class="card-body">
                        {{-- Menampilkan daftar error jika ada --}}
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Oops! Terjadi kesalahan:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- Judul HKI --}}
                        <div class="form-group mb-3">
                            <label for="judul_hki" class="form-label">Judul HKI</label>
                            <input type="text" name="judul_hki" id="judul_hki" class="form-control"
                                value="{{ old('judul_hki', $hki->judul_hki) }}" required>
                        </div>

                        {{-- Jenis HKI --}}
                        <div class="form-group mb-3">
                            <label for="jenis_hki" class="form-label">Jenis HKI</label>
                            <input type="text" name="jenis_hki" id="jenis_hki" class="form-control"
                                value="{{ old('jenis_hki', $hki->jenis_hki) }}" required>
                        </div>

                        {{-- Nomor Pendaftaran --}}
                        <div class="form-group mb-3">
                            <label for="nomor_pendaftaran" class="form-label">Nomor Pendaftaran</label>
                            <input type="text" name="nomor_pendaftaran" id="nomor_pendaftaran" class="form-control"
                                value="{{ old('nomor_pendaftaran', $hki->nomor_pendaftaran) }}">
                        </div>

                        {{-- Tanggal Pendaftaran --}}
                        <div class="form-group mb-3">
                            <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran</label>
                            <input type="date" name="tanggal_pendaftaran" id="tanggal_pendaftaran" class="form-control"
                                value="{{ old('tanggal_pendaftaran', $hki->tanggal_pendaftaran) }}" required>
                        </div>

                        {{-- Input Pemilik Nama --}}
                        <div class="form-group mb-3">
                            <label for="pemilik_nama" class="form-label">Nama Pemilik</label>
                            {{--
                            Logika untuk mengisi textarea:
                            1. Gunakan old('pemilik_nama') jika ada (setelah validasi gagal).
                            2. Jika tidak, ambil nama pemilik dari relasi ($hki->pemilik),
                            gunakan pluck() untuk mendapatkan array nama, lalu
                            implode() dengan pemisah titik koma.
                            --}}
                            <textarea name="pemilik_nama" id="pemilik_nama" class="form-control" rows="3"
                                required>{{ old('pemilik_nama', $hki->pemilik->pluck('nama_pemilik')->implode('; ')) }}</textarea>
                            <small class="form-text text-muted">Masukkan satu atau lebih nama pemilik. Pisahkan dengan
                                titik koma ( ; ).</small>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin-hki') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection