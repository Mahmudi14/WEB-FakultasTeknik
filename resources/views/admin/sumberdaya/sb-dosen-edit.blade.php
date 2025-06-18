@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Dosen</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Dosen</h3>
                </div>
                {{-- Form action mengarah ke route update dengan ID pimpinan --}}
                <form action="{{ route('admin-dosen.update', $dosen->id) }}" method="POST"
                    enctype="multipart/form-data">
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="form-group mb-3">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama', $dosen->nama) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control" id="nidn" name="nidn"
                                value="{{ old('nidn', $dosen->nidn) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="program_studi">Program Studi</label>
                            <input type="text" class="form-control" id="program_studi" name="program_studi"
                                value="{{ old('program_studi', $dosen->program_studi) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="pendidikan">Pendidikan Terakhir</label>
                            <select class="form-control" id="pendidikan" name="pendidikan" required>
                                <option value="" disabled>-- Pilih Jenjang --</option>
                                <option value="S2" {{ old('pendidikan', $dosen->pendidikan) == 'S2' ? 'selected' : ''
                                    }}>S2 (Magister)</option>
                                <option value="S3" {{ old('pendidikan', $dosen->pendidikan) == 'S3' ? 'selected' : ''
                                    }}>S3 (Doktor)</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="jabatan_fungsional">Jabatan Fungsional</label>
                            <input type="text" class="form-control" id="jabatan_fungsional" name="jabatan_fungsional"
                                value="{{ old('jabatan_fungsional', $dosen->jabatan_fungsional) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gambar">Ganti Foto Dosen (Opsional)</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                            @if($dosen->gambar)
                            <div class="mt-2">
                                <p>Foto Saat Ini:</p>
                                <img src="{{ asset('storage/' . $dosen->gambar) }}" alt="{{ $dosen->nama }}"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin-dosen') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection