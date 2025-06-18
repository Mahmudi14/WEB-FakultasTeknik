@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    {{-- Header Konten --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Kategori</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama --}}
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Kategori</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin-kategori.update', $kategori->slug) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="nama">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" placeholder="Masukkan nama kategori"
                                value="{{ old('nama', $kategori->nama) }}" required>

                            {{-- Menampilkan pesan error validasi untuk field 'nama' --}}
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                        <a href="{{ route('admin-kategori.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection