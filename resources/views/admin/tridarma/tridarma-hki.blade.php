@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hak Kekayaan Intelektual</h1>
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
                                        <th>Judul Karya</th>
                                        <th>Jenis</th>
                                        <th>Pemilik</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th style="width: 120px" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hki_list as $hki)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $hki->judul_hki }}</td>
                                        <td>{{ $hki->jenis_hki }}</td>
                                        <td>
                                            @if($hki->pemilik->isNotEmpty())
                                            <ul class="pl-3 mb-0">
                                                @foreach($hki->pemilik as $p)
                                                <li>{{ $p->nama_pemilik }}</li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($hki->tanggal_pendaftaran)->format('d F Y') }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('admin-hki.edit', $hki->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('admin-hki.destroy', $hki->id) }}" method="POST">
                                                    @csrf @method('DELETE')
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
                                        <td colspan="6" class="text-center">Belum ada data HKI.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-hki">
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
        <div class="modal fade" id="modal-tambah-hki" tabindex="-1" aria-labelledby="modalTambahHkiLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahHkiLabel">Tambah HKI Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin-hki.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="judul_hki">Judul Karya</label>
                                <input type="text" class="form-control @error('judul_hki') is-invalid @enderror"
                                    id="judul_hki" name="judul_hki" value="{{ old('judul_hki') }}" required>
                                @error('judul_hki')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jenis_hki">Jenis HKI</label>
                                        <input type="text" class="form-control @error('jenis_hki') is-invalid @enderror"
                                            id="jenis_hki" name="jenis_hki" value="{{ old('jenis_hki') }}"
                                            placeholder="Contoh: Paten, Hak Cipta" required>
                                        @error('jenis_hki')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
                                        <input type="date"
                                            class="form-control @error('tanggal_pendaftaran') is-invalid @enderror"
                                            id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                                            value="{{ old('tanggal_pendaftaran') }}" required>
                                        @error('tanggal_pendaftaran')<div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nomor_pendaftaran">Nomor Pendaftaran (Opsional)</label>
                                <input type="text" class="form-control @error('nomor_pendaftaran') is-invalid @enderror"
                                    id="nomor_pendaftaran" name="nomor_pendaftaran"
                                    value="{{ old('nomor_pendaftaran') }}">
                                @error('nomor_pendaftaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="pemilik_nama" class="form-label">Nama Pemilik</label>
                                <textarea name="pemilik_nama" id="pemilik_nama"
                                    class="form-control @error('pemilik_nama') is-invalid @enderror" rows="3"
                                    required>{{ old('pemilik_nama') }}</textarea>
                                @error('pemilik_nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                <small class="form-text text-muted">Masukkan satu atau lebih nama pemilik. Pisahkan
                                    dengan
                                    titik koma ( ; ).</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div><!-- /.container-fluid -->

@endsection