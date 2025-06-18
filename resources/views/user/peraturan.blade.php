@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Peraturan --}}
@push('styles')
<style>
  /* Mengimpor Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

  /* Menambahkan box-sizing universal */
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .peraturan-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .peraturan-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .peraturan-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  .peraturan-list-container-v2 {
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 900px;
    margin: 0 auto;
  }

  .peraturan-item-v2 {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 20px 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid #e9ecef;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .peraturan-item-v2:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 86, 179, 0.1);
  }

  .peraturan-icon-v2 {
    font-size: 2rem;
    color: #dc3545;
    /* Warna merah khas PDF */
    flex-shrink: 0;
  }

  .peraturan-nama-v2 {
    font-size: 1.1rem;
    font-weight: 500;
    color: #333;
    flex-grow: 1;
    /* Membuat nama mengisi ruang */
    margin: 0;
  }

  .peraturan-download-btn-v2 {
    margin-left: auto;
    padding: 8px 18px;
    border-radius: 50px;
    background-color: #0056b3;
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    white-space: nowrap;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .peraturan-download-btn-v2:hover {
    background-color: #004488;
  }

  @media (max-width: 768px) {
    .peraturan-section-v2 {
      padding: 40px 15px;
    }

    .peraturan-title-v2 {
      font-size: 2rem;
    }

    .peraturan-item-v2 {
      flex-direction: column;
      align-items: flex-start;
      text-align: left;
    }

    .peraturan-download-btn-v2 {
      margin-left: 0;
      margin-top: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="peraturan-section-v2">
  <h2 class="peraturan-title-v2">Peraturan Akademik</h2>
  <hr class="peraturan-line-v2" />

  <div class="peraturan-list-container-v2">
    {{-- Asumsi $peraturans adalah koleksi yang dikirim dari controller --}}
    @forelse ($peraturans as $peraturan)
    <div class="peraturan-item-v2">
      <i class="fas fa-file-pdf peraturan-icon-v2"></i>
      <h3 class="peraturan-nama-v2">{{ $peraturan->nama_peraturan ?? 'Nama Dokumen Peraturan' }}</h3>
      <a href="{{ asset('storage/' . $peraturan->link_dokumen) }}" target="_blank" class="peraturan-download-btn-v2">
        <i class="fas fa-download"></i>
        <span>Unduh</span>
      </a>
    </div>
    @empty
    {{-- Contoh jika data kosong --}}
    <div class="peraturan-item-v2">
      <i class="fas fa-file-pdf peraturan-icon-v2"></i>
      <h3 class="peraturan-nama-v2">Contoh Peraturan Akademik Fakultas</h3>
      <a href="#" class="peraturan-download-btn-v2">
        <i class="fas fa-download"></i>
        <span>Unduh</span>
      </a>
    </div>
    <div class="peraturan-item-v2">
      <i class="fas fa-file-pdf peraturan-icon-v2"></i>
      <h3 class="peraturan-nama-v2">Panduan Penulisan Skripsi</h3>
      <a href="#" class="peraturan-download-btn-v2">
        <i class="fas fa-download"></i>
        <span>Unduh</span>
      </a>
    </div>
    @endforelse
  </div>
</section>

@endsection