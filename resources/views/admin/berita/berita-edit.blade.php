@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    {{-- Header Konten --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Berita</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama --}}
    <section class="content">
        <div class="container-fluid">
            {{-- Notifikasi Error Validasi --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops! Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin-berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    {{-- Kolom Kiri - Konten Utama --}}
                    <div class="col-md-8">
                        <div class="card card-warning">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="judul">Judul Berita</label>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ old('judul', $berita->judul) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="konten">Konten Berita</label>
                                    <textarea class="form-control" id="konten" name="konten"
                                        rows="15">{{ old('konten', $berita->konten) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan - Pengaturan Tambahan --}}
                    <div class="col-md-4">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Pengaturan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="published" {{ old('status', $berita->status) == 'published' ?
                                            'selected' : '' }}>Published</option>
                                        <option value="draft" {{ old('status', $berita->status) == 'draft' ? 'selected'
                                            : '' }}>Draft</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gambar">Ganti Gambar Unggulan</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                    @if($berita->gambar)
                                    <div class="mt-2">
                                        <p>Gambar saat ini:</p>
                                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                                            style="max-width: 200px; border-radius: 5px;">
                                    </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <div class="p-2 rounded border" style="max-height: 200px; overflow-y: auto;">
                                        @foreach($kategoris as $kategori)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="kategoris[]"
                                                value="{{ $kategori->id }}" id="kategori-{{ $kategori->id }}"
                                                @if($errors->any())
                                            {{ in_array($kategori->id, old('kategoris', [])) ? 'checked' : '' }}
                                            @else
                                            {{ $berita->kategoris->contains($kategori->id) ? 'checked' : '' }}
                                            @endif
                                            >
                                            <label class="form-check-label" for="kategori-{{ $kategori->id }}">
                                                {{ $kategori->nama }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning w-100">Simpan Perubahan</button>
                                <a href="{{ route('admin-berita') }}" class="btn btn-secondary w-100 mt-2">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection