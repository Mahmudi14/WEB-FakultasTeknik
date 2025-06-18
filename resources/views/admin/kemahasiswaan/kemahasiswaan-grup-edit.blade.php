@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    {{-- Header Halaman --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Grup</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin-grup.update', $grup->id) }}" method="POST">
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

                            {{-- Input untuk Nama Grup --}}
                            <div class="form-group mb-3">
                                <label for="nama_grup">Nama Grup</label>
                                <input type="text" class="form-control" id="nama_grup" name="nama_grup"
                                    value="{{ old('nama_grup', $grup->nama_grup) }}" required>
                            </div>

                            {{-- Input untuk Platform --}}
                            <div class="form-group mb-3">
                                <label for="platform">Platform</label>
                                <input type="text" class="form-control" id="platform" name="platform"
                                    value="{{ old('platform', $grup->platform) }}"
                                    placeholder="Contoh: WhatsApp, Facebook, Telegram" required>
                            </div>

                            {{-- Input untuk Link --}}
                            <div class="form-group mb-3">
                                <label for="link">Link</label>
                                <input type="url" class="form-control" id="link" name="link"
                                    value="{{ old('link', $grup->link) }}" placeholder="https://chat.whatsapp.com/..."
                                    required>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin-grup') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
@endsection