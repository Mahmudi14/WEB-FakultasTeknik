@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Layanan Kemahasiswaan</h1>
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
                                        <th style="width: 10px">No</th>
                                        <th>Nama</th>
                                        <th>Link</th>
                                        <th style="width: 110px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($layanan_list as $index => $layanan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $layanan->nama }}</td>
                                        <td class="align-middle">
                                            <a href="{{ $layanan->link }}" target="_blank">{{ Str::limit($layanan->link,
                                                50)
                                                }}</a>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('admin-layanan.edit', $layanan->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('admin-layanan.destroy', $layanan->id) }}"
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
                                        <td colspan="4" class="text-center">Belum ada data peraturan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-layanan">
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

        {{-- Modal Tambah Layanan --}}
        <div class="modal fade" id="modal-tambah-layanan">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Layanan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-layanan.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                {{-- Input Nama Layanan --}}
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama Layanan</label>
                                    <input type="text" name="nama" id="nama"
                                        class="form-control @error('nama') is-invalid @enderror" required>
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                {{-- Input Link --}}
                                <div class="form-group mb-3">
                                    <label for="link" class="form-label">Link URL</label>
                                    <input type="url" name="link" id="link"
                                        class="form-control @error('link') is-invalid @enderror"
                                        placeholder="https://contoh.com" required>
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