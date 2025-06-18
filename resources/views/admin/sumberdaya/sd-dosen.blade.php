@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dosen</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            {{-- Menampilkan pesan sukses atau error --}}
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
                                        <th>Program Studi</th>
                                        <th>Pendidikan</th>
                                        <th>NIDN</th>
                                        <th>Jabatan Fungsional</th>
                                        <th class="text-center align-middle">Gambar</th>
                                        <th style="width: 110px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dosen_list as $dosen)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $dosen->nama }}</td>
                                        <td class="align-middle">{{ $dosen->nidn }}</td>
                                        <td class="align-middle">{{ $dosen->program_studi }}</td>
                                        <td class="align-middle">{{ $dosen->pendidikan }}</td>
                                        <td class="align-middle">{{ $dosen->jabatan_fungsional }}</td>
                                        <td class="text-center align-middle">
                                            @if($dosen->gambar)
                                            <img src="{{ asset('storage/' . $dosen->gambar) }}" alt="{{ $dosen->nama }}"
                                                class="img-fluid rounded"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('admin-dosen.edit', $dosen->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('admin-dosen.destroy', $dosen->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Anda yakin ingin menghapus data dosen ini?');">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    {{-- Tampilan jika tidak ada data sama sekali --}}
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data dosen.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-dosen">
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

        {{-- Modal Tambah Dosen --}}
        <div class="modal fade" id="modal-tambah-dosen">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Dosen</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                {{-- Input untuk Nama --}}
                                <div class="form-group mb-3">
                                    <label for="nama_pimpinan">Nama</label>
                                    <input type="text" class="form-control" id="nama_pimpinan" name="nama"
                                        placeholder="Masukkan Nama Lengkap" required>
                                </div>
                                {{-- Input untuk Program Studi --}}
                                <div class="form-group mb-3">
                                    <label for="program_studi">Program Studi</label>
                                    <input type="text" class="form-control" id="program_studi" name="program_studi"
                                        placeholder="Masukkan Program Studi" required>
                                </div>

                                {{-- Input untuk Pendidikan --}}
                                <div class="form-group mb-3">
                                    <label for="pendidikan">Pendidikan</label>
                                    <select class="form-control" id="pendidikan" name="pendidikan" required>
                                        <option value="" disabled selected>-- Pilih Jenjang Pendidikan --</option>
                                        <option value="S2">S2 (Magister)</option>
                                        <option value="S3">S3 (Doktor)</option>
                                    </select>
                                </div>

                                {{-- Input untuk NIDN --}}
                                <div class="form-group mb-3">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" class="form-control" id="nidn" name="nidn"
                                        placeholder="Masukkan NIDN" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="jabatan_fungsional">Jabatan Fungsional</label>
                                    <input type="text" class="form-control" id="jabatan_fungsional"
                                        name="jabatan_fungsional" placeholder="Masukkan Jabatan Fungsional" required>
                                </div>

                                {{-- Input untuk Gambar --}}
                                <div class="form-group mb-3">
                                    <label for="gambar_pimpinan">Gambar</label>
                                    <input type="file" class="form-control" id="gambar_pimpinan" name="gambar" required>
                                    <small class="form-text text-muted">Pilih file gambar (jpg, png, svg, dll.)</small>
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