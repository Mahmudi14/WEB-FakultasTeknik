@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tenaga Kependidikan</h1>
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
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th>Gambar</th>
                                        <th style="width: 110px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tendik_list as $tendik)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $tendik->nama }}</td>
                                        <td class="align-middle">{{ $tendik->jabatan }}</td>
                                        <td class="align-middle">{{ $tendik->unit_kerja }}</td>
                                        <td class="text-center align-middle">
                                            @if($tendik->gambar)
                                            <img src="{{ asset('storage/' . $tendik->gambar) }}"
                                                alt="{{ $tendik->nama }}" class="img-fluid rounded"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('admin-tenaga-kependidikan.edit', $tendik->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form
                                                    action="{{ route('admin-tenaga-kependidikan.destroy', $tendik->id) }}"
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
                                    {{-- Tampilan jika tidak ada data --}}
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data tenaga kependidikan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-tendik">
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

        {{-- Modal Tambah Tenaga Kependidikan --}}
        <div class="modal fade" id="modal-tambah-tendik">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Tenaga Kependidikan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}" required>
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                        id="jabatan" name="jabatan" value="{{ old('jabatan') }}" required>
                                    @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="unit_kerja">Unit Kerja</label>
                                    <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror"
                                        id="unit_kerja" name="unit_kerja" value="{{ old('unit_kerja') }}" required>
                                    @error('unit_kerja')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="gambar">Foto</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                        id="gambar" name="gambar" required>
                                    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Data</button>
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