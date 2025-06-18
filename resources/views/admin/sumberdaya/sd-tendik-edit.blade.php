@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Tenaga Kependidikan</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Tenaga Kependidikan</h3>
                </div>
                {{-- Form action mengarah ke route update dengan ID pimpinan --}}
                <form action="{{ route('admin-tenaga-kependidikan.update', $tendik->id) }}" method="POST"
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $tendik->nama) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                value="{{ old('jabatan', $tendik->jabatan) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="unit_kerja">Unit Kerja</label>
                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"
                                value="{{ old('unit_kerja', $tendik->unit_kerja) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gambar">Ganti Foto (Opsional)</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                            @if($tendik->gambar)
                            <div class="mt-2">
                                <p>Foto Saat Ini:</p>
                                <img src="{{ asset('storage/' . $tendik->gambar) }}" alt="{{ $tendik->nama }}"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin-tenaga-kependidikan') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection