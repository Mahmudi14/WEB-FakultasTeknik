@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Grup Alumni</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ($errors->any() && session('show_modal_add'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops! Gagal menambahkan data:</strong>
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
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px" class="text-center">No</th>
                                        <th>Nama Grup</th>
                                        <th>Platform</th>
                                        <th>Link</th>
                                        <th style="width: 120px" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($grup_alumni_list as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $item->nama_grup }}</td>
                                        <td class="align-middle">{{ $item->platform }}</td>
                                        <td class="align-middle">
                                            <a href="{{ $item->link }}" target="_blank">{{ Str::limit($item->link, 50)
                                                }}</a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('admin-grup.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('admin-grup.destroy', $item->id) }}"
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
                                        <td colspan="5" class="text-center">Belum ada data grup alumni.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-grup">
                                Tambah
                            </button>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
        {{-- Modal Tambah Grup --}}
        <div class="modal fade" id="modal-tambah-grup">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Grup</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-grup.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="nama_grup">Nama Grup</label>
                                    <input type="text" class="form-control @error('nama_grup') is-invalid @enderror"
                                        id="nama_grup" name="nama_grup" value="{{ old('nama_grup') }}" required>
                                    @error('nama_grup')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="platform">Platform</label>
                                    <input type="text" class="form-control @error('platform') is-invalid @enderror"
                                        id="platform" name="platform" value="{{ old('platform') }}"
                                        placeholder="Contoh: WhatsApp, Facebook, Telegram" required>
                                    @error('platform')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="link">Link</label>
                                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link"
                                        name="link" value="{{ old('link') }}"
                                        placeholder="https://chat.whatsapp.com/..." required>
                                    @error('link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
</div><!-- /.container-fluid -->

@endsection