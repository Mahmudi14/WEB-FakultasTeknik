@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Visi Misi</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Oops! Ada kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-body">
                            @if(isset($visi) && $visi && !empty($visi->konten))
                            {{ $visi->konten }}
                            @else
                            <p>Belum ada data sejarah yang dimasukkan.</p>
                            @endif
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">
                            {{-- Footer card jika diperlukan --}}
                            <div class="text-right">
                                <a href="#" class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modal-visi">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square mr-1" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.813z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                    Edit Visi
                                </a>
                            </div>
                        </div>
                        {{-- /.card-footer--}}
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Misi</th>
                                        <th style="width: 110px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($misi as $mi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mi->deskripsi_misi }}</td>
                                        <td style="vertical-align: middle;">
                                            <div style="display: flex; gap: 8px;">
                                                <a href="{{ route('admin-misi.edit', $mi->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <form action="{{ route('admin-misi.destroy', $mi->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Anda yakin ingin menghapus misi ini?');">
                                                        {{-- Konfirmasi JS Sederhana --}}
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-tambah-misi">
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


        {{-- Modal-Visi --}}
        <div class="modal fade" id="modal-visi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Visi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-visi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea class="form-control @error('konten') is-invalid @enderror" name="konten"
                                        rows="5" required> {{ old('konten', isset($visi) ? $visi->konten : '') }}
                                    </textarea>
                                    @error('konten')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        {{-- Modal Tambah Misi --}}
        <div class="modal fade" id="modal-tambah-misi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Misi Visi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin-misi.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea type="text" class="form-control" name="deskripsi_misi" required>
                                    </textarea>
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