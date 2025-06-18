@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    {{-- Header Halaman --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Sarana dan Prasarana</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    {{-- Form disesuaikan untuk update SaranaPrasarana --}}
                    <form action="{{ route('admin-sarana.update', $sarana->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing untuk request PUT --}}
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong>Oops! Terjadi kesalahan:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            {{-- Input untuk Nama Sarana/Prasarana --}}
                            <div class="form-group mb-3">
                                <label for="nama">Nama Sarana/Prasarana</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ old('nama', $sarana->nama) }}" required>
                            </div>

                            {{-- Input untuk Gambar --}}
                            <div class="form-group mb-3">
                                <label for="gambar">Ganti Gambar (Opsional)</label>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                                @if($sarana->gambar)
                                <div class="mt-2">
                                    <p>Gambar Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $sarana->gambar) }}" alt="{{ $sarana->nama }}"
                                        style="max-width: 200px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin-sarana') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
@endsection