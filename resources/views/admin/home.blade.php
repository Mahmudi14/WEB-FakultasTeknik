@extends('layout.admin-app')

{{-- Menambahkan CSS kustom --}}
@push('styles')
<style>
    .preview-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 24px;
    }

    .preview-header {
        text-align: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e9ecef;
    }

    .preview-header h5 {
        color: #007bff;
        font-weight: 600;
        margin: 0;
    }

    .preview-content .preview-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: block;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .preview-title-box {
        background-color: #f8f9fa;
        border: 1px dashed #ced4da;
        padding: 24px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .preview-title-box h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #343a40;
        margin: 0;
    }

    .preview-sambutan-box p {
        background-color: #f8f9fa;
        border: 1px dashed #ced4da;
        padding: 16px;
        border-radius: 8px;
        color: #495057;
        line-height: 1.7;
        font-style: italic;
    }
</style>
@endpush

@section('content')
<div class="container mt-3">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
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

            {{-- [PERUBAHAN] Struktur Tampilan Baru --}}
            <div class="row">
                <div class="col-12">
                    <div class="preview-card">
                        <div class="preview-content">
                            <label class="preview-label">Hero Title</label>
                            <div class="preview-title-box">
                                <h1>{{ optional($halamanUtama)->hero_title ?? 'Belum ada judul.' }}</h1>
                            </div>

                            <label class="preview-label">Kata Sambutan Dekan</label>
                            <div class="preview-sambutan-box">
                                <p>{!! nl2br(e(optional($halamanUtama)->sambutan_dekan ?? 'Belum ada kata sambutan.'))
                                    !!}</p>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent text-right">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-halaman-utama">
                                <i class="fas fa-pencil-alt mr-1"></i>
                                Edit Konten
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>


{{-- Modal untuk Edit Halaman Utama --}}
<div class="modal fade" id="modal-edit-halaman-utama" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Konten Halaman Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin-home.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="hero_title">Judul Utama (Hero Title)</label>
                        <input type="text" class="form-control @error('hero_title') is-invalid @enderror"
                            id="hero_title" name="hero_title" required>{{ old('konten', isset($halamanUtama) ?
                        $halamanUtama->hero_title : '')}}
                        @error('hero_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="sambutan_dekan">Kata Sambutan Dekan</label>
                        <textarea name="sambutan_dekan" id="sambutan_dekan"
                            class="form-control @error('sambutan_dekan') is-invalid @enderror" rows="8" required>{{ old('konten', isset($halamanUtama) ?
                        $halamanUtama->sambutan_dekan : '')}}</textarea>
                        @error('sambutan_dekan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- Script untuk membuka kembali modal jika ada error validasi --}}
@push('scripts')
<script>
    @if ($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('modal-edit-halaman-utama'));
        myModal.show();
    @endif
</script>
@endpush