@extends('layout.admin-app')

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Misi</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin-misi.update', $misi->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Method spoofing untuk update --}}
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Oops! Ada kesalahan:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="form-group mb-3">
                                <textarea class="form-control" id="deskripsi_misi" name="deskripsi_misi" rows="5"
                                    required>{{ old('deskripsi_misi', $misi->deskripsi_misi) }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin-visi-misi') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection