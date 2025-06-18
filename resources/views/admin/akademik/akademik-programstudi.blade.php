@extends('layout.admin-app')

@section('content')<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program Studi</h1>
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

            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px" class="text-center">No</th>
                                <th>Program Studi</th>
                                <th>Koordinator</th>
                                <th class="text-center">Gambar</th>
                                <th style="width: 120px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Perulangan @forelse untuk menampilkan data --}}
                            @forelse($program_studi_list as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $item->program_studi }}</td>
                                <td class="align-middle">{{ $item->koordinator }}</td>
                                <td class="text-center align-middle">
                                    @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->program_studi }}"
                                        class="img-fluid rounded" style="max-width: 150px;">
                                    @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="d-flex justify-content-center" style="gap: 8px;">
                                        {{-- Tombol Edit mengarah ke halaman edit terpisah --}}
                                        <a href="{{ route('admin-program-studi.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        {{-- Tombol Hapus menggunakan form untuk request DELETE --}}
                                        <form action="{{ route('admin-program-studi.destroy', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Anda yakin ingin menghapus program studi ini?');">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{-- Tampilan jika tidak ada data sama sekali --}}
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data program studi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal"
                        data-bs-target="#modal-tambah-prodi">
                        Tambah Program Studi
                    </button>
                </div>
            </div>
        </div>
        <!-- /.row -->

        {{-- Modal Tambah Program Studi --}}
        <div class="modal fade" id="modal-tambah-prodi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Program Studi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-program-studi.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                {{-- Input untuk Program Studi --}}
                                <div class="form-group mb-3">
                                    <label for="program_studi">Program Studi</label>
                                    <input type="text" class="form-control" id="program_studi" name="program_studi"
                                        placeholder="Masukkan Nama Program Studi" required>
                                </div>

                                {{-- Input untuk Koordinator --}}
                                <div class="form-group mb-3">
                                    <label for="koordinator">Koordinator</label>
                                    <input type="text" class="form-control" id="koordinator" name="koordinator"
                                        placeholder="Masukkan Nama koordinator" required>
                                </div>

                                {{-- Input untuk Gambar --}}
                                <div class="form-group mb-3">
                                    <label for="gambar_koordinator">Gambar</label>
                                    <input type="file" class="form-control" id="gambar_koordinator" name="gambar"
                                        required>
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