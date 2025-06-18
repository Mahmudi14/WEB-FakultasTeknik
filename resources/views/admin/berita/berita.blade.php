@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    {{-- Header Konten --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Berita</h1>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten Utama --}}
    <section class="content">
        <div class="container-fluid">
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Notifikasi Error (jika ada) --}}
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

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin-berita.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Berita Baru
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 15%">Gambar</th>
                                    <th>Judul</th>
                                    <th>Slug</th>
                                    <th style="width: 15%">Kategori</th>
                                    <th style="width: 10%">Status</th>
                                    <th class="text-center align-middle" style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beritas as $index => $berita)
                                <tr>
                                    <td class="align-middle">{{ $beritas->firstItem() + $index }}</td>
                                    <td class="align-middle">
                                        @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                                            style="max-width: 200px; border-radius: 5px;">
                                        @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $berita->judul }}</td>
                                    <td class="align-middle">{{ $berita->slug }}</td>
                                    <td class="align-middle">
                                        @foreach($berita->kategoris as $kategori)
                                        <span class="badge bg-secondary">{{ $kategori->nama }}</span>
                                        @endforeach
                                    </td>
                                    <td class="align-middle">
                                        @if($berita->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center" style="gap: 8px;">
                                            <a href="{{ route('admin-berita.edit', $berita->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('admin-berita.destroy', $berita->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Anda yakin ingin menghapus data ini?');">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data berita.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $beritas->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>
</div>
@endsection