@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pimpinan</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th style="width: 500px">Nama</th>
                                        <th style="width: 400px">Jabatan</th>
                                        <th class="d-flex justify-content-center">Gambar</th>
                                        <th class="text-center align-middle" style=" width: 110px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pimpinan_list as $pimpinan)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $pimpinan->nama }}</td>
                                        <td class="align-middle">{{ $pimpinan->jabatan }}</td>
                                        <td class="text-center">
                                            @if($pimpinan->gambar)
                                            <img src="{{ asset('storage/' . $pimpinan->gambar) }}"
                                                class="img-fluid rounded shadow" style="max-width: 100px;"
                                                alt="{{ $pimpinan->nama }}">
                                            @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="{{ route('admin-pimpinan.edit', $pimpinan->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>

                                                {{-- Form untuk tombol Hapus --}}
                                                <form action="{{ route('admin-pimpinan.destroy', $pimpinan->id) }}"
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
                                    {{-- Tampilan jika tidak ada data pimpinan --}}
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data pimpinan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-pimpinan">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->

        {{-- Modal Tambah Pimpinan --}}
        <div class="modal fade" id="modal-tambah-pimpinan">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pimpinan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-pimpinan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                {{-- Input untuk Nama --}}
                                <div class="form-group mb-3">
                                    <label for="nama_pimpinan">Nama</label>
                                    <input type="text" class="form-control" id="nama_pimpinan" name="nama"
                                        placeholder="Masukkan Nama Lengkap" required>
                                </div>

                                {{-- Input untuk Jabatan --}}
                                <div class="form-group mb-3">
                                    <label for="jabatan_pimpinan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan_pimpinan" name="jabatan"
                                        placeholder="Masukkan Jabatan" required>
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