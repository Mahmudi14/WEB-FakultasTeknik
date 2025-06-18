@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    {{-- Header Halaman --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Program Studi</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                        {{-- Form disesuaikan untuk update Program Studi --}}
                        <form action="{{ route('admin-program-studi.update', $program_studi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Method spoofing untuk update --}}
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Oops! Ada kesalahan:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif

                                {{-- Input untuk Nama Program Studi --}}
                                <div class="form-group mb-3">
                                    <label for="program_studi">Nama Program Studi</label>
                                    <input type="text" class="form-control" id="program_studi" name="program_studi"
                                        value="{{ old('program_studi', $program_studi->program_studi) }}" required>
                                </div>

                                {{-- Input untuk Nama Koordinator --}}
                                <div class="form-group mb-3">
                                    <label for="koordinator">Nama Koordinator</label>
                                    <input type="text" class="form-control" id="koordinator" name="koordinator"
                                        value="{{ old('koordinator', $program_studi->koordinator) }}" required>
                                </div>

                                {{-- Input untuk Gambar --}}
                                <div class="form-group mb-3">
                                    <label for="gambar">Ganti Gambar (Opsional)</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti
                                        gambar.</small>
                                    @if($program_studi->gambar)
                                    <div class="mt-2">
                                        <p>Gambar Saat Ini:</p>
                                        <img src="{{ asset('storage/' . $program_studi->gambar) }}"
                                            alt="{{ $program_studi->program_studi }}"
                                            style="max-width: 200px; border-radius: 5px;">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('admin-program-studi') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection