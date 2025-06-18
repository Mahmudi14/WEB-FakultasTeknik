@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Dosen --}}
@push('styles')
<style>
  /* Mengimpor Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

  /* [PERBAIKAN] Menambahkan box-sizing universal */
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .dosen-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .dosen-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .dosen-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  /* [PERUBAHAN] Styling untuk tabel */
  .table-container-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    overflow-x: auto;
    /* Membuat tabel bisa di-scroll horizontal di layar kecil */
  }

  .dosen-table-v2 {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }

  .dosen-table-v2 th,
  .dosen-table-v2 td {
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
  }

  .dosen-table-v2 thead th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
    text-transform: uppercase;
    font-size: 0.9rem;
    white-space: nowrap;
  }

  .dosen-table-v2 tbody tr:last-child td {
    border-bottom: none;
  }

  .dosen-table-v2 tbody tr:hover {
    background-color: #f1f1f1;
  }

  .dosen-foto-profil {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
  }

  .dosen-nama-table {
    font-weight: 600;
    color: #333;
  }

  .dosen-nidn-table {
    font-size: 0.9rem;
    color: #6c757d;
  }

  @media (max-width: 768px) {
    .dosen-section-v2 {
      padding: 40px 15px;
    }

    .dosen-title-v2 {
      font-size: 2rem;
    }
  }
</style>
@endpush

@section('isi')

<section class="dosen-section-v2">
  <h2 class="dosen-title-v2">Dosen</h2>
  <hr class="dosen-line-v2" />

  {{-- [PERUBAHAN] Grid diganti dengan kontainer tabel --}}
  <div class="table-container-v2">
    <table class="dosen-table-v2">
      <thead>
        <tr>
          <th style="width: 5%;">#</th>
          <th style="width: 10%;">Foto</th>
          <th>Nama & NIDN</th>
          <th>Jabatan Fungsional</th>
          <th>Program Studi</th>
          <th>Pendidikan</th>
        </tr>
      </thead>
      <tbody>
        {{-- Asumsi $dosens adalah koleksi yang dikirim dari controller --}}
        @forelse ($dosens as $index => $dosen)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>
            @if($dosen->gambar)
            <img src="{{ asset('storage/' . $dosen->gambar) }}" alt="Foto {{ $dosen->nama }}" class="dosen-foto-profil">
            @else
            <img src="https://placehold.co/150x150/6c757d/FFFFFF?text=Foto" alt="Foto Dosen" class="dosen-foto-profil">
            @endif
          </td>
          <td>
            <div class="dosen-nama-table">{{ $dosen->nama ?? 'Nama Dosen' }}</div>
            <div class="dosen-nidn-table">NIDN: {{ $dosen->nidn ?? '...' }}</div>
          </td>
          <td>{{ $dosen->jabatan_fungsional ?? 'Jabatan Fungsional' }}</td>
          <td>{{ $dosen->program_studi ?? 'Program Studi' }}</td>
          <td>{{ $dosen->pendidikan ?? 'Pendidikan Terakhir' }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5">
            <p class="text-muted">Belum ada data dosen yang ditambahkan.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

@endsection