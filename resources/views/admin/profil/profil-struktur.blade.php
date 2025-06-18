@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Struktur Organisasi</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">

            {{-- Menampilkan pesan sukses atau error --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops! Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <div class="card-tools">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modal-struktur">
                                    <i class="bi bi-pencil-fill"></i> Edit Gambar
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-center p-3">
                            {{-- Menampilkan gambar struktur dari database --}}
                            @if(isset($struktur) && $struktur->gambar)
                            <img src="{{ asset('storage/' . $struktur->gambar) }}" class="img-fluid rounded shadow-sm"
                                style="max-width: 100%; height: auto;" alt="Struktur Organisasi">
                            @else
                            <div class="alert alert-info">
                                Belum ada gambar struktur organisasi yang diunggah. Silakan klik tombol "Edit Gambar"
                                untuk mengunggah.
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            {{-- Modal Edit Struktur --}}
            <div class="modal fade" id="modal-struktur" tabindex="-1" aria-labelledby="modalStrukturLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalStrukturLabel">Edit Gambar Struktur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- Form disesuaikan untuk unggah gambar --}}
                            <form action="{{ route('admin-struktur.storeOrUpdate') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="gambarStruktur" class="form-label">Pilih Gambar Baru</label>
                                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                            id="gambarStruktur" name="gambar" required>
                                        @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Tipe file yang diizinkan: jpeg, png, jpg,
                                            svg. Ukuran maksimal 5MB.</small>
                                    </div>

                                    @if(isset($struktur) && $struktur->gambar)
                                    <div class="mt-3">
                                        <p>Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $struktur->gambar) }}" class="img-fluid rounded"
                                            style="max-width: 400px;" alt="Struktur Saat Ini">
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan & Unggah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection