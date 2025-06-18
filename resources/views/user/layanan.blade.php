@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Layanan --}}
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

  .layanan-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    background-color: #ffffff;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .layanan-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .layanan-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  .layanan-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .layanan-card-link-v2 {
    text-decoration: none;
  }

  .layanan-card-v2 {
    background-color: #f8f9fa;
    border-radius: 15px;
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    border: 1px solid #e9ecef;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    height: 200px;
  }

  .layanan-card-v2:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 86, 179, 0.1);
    border-color: #0056b3;
  }

  .layanan-icon-v2 {
    font-size: 3rem;
    color: #0056b3;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
  }

  .layanan-card-v2:hover .layanan-icon-v2 {
    transform: scale(1.1);
  }

  .layanan-nama-v2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  @media (max-width: 768px) {
    .layanan-section-v2 {
      padding: 40px 15px;
    }

    .layanan-title-v2 {
      font-size: 2rem;
    }

    .layanan-grid-v2 {
      gap: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="layanan-section-v2">
  <h2 class="layanan-title-v2">Layanan</h2>
  <hr class="layanan-line-v2" />

  <div class="layanan-grid-v2">
    {{-- Asumsi $layanans adalah koleksi yang dikirim dari controller --}}
    @forelse ($layanans as $layanan)
    <a href="{{ $layanan->link ?? '#' }}" target="_blank" class="layanan-card-link-v2">
      <div class="layanan-card-v2">
        {{-- Logika untuk menampilkan ikon berdasarkan nama layanan --}}
        @php
        $iconClass = 'fa-link'; // Default icon
        if (stripos($layanan->nama, 'SIAKAD') !== false) $iconClass = 'fa-university';
        if (stripos($layanan->nama, 'Tracer') !== false) $iconClass = 'fa-user-graduate';
        if (stripos($layanan->nama, 'Jurnal') !== false) $iconClass = 'fa-book-open';
        if (stripos($layanan->nama, 'Info') !== false) $iconClass = 'fa-info-circle';
        @endphp
        <i class="fas {{ $iconClass }} layanan-icon-v2"></i>
        <h3 class="layanan-nama-v2">{{ $layanan->nama ?? 'Nama Layanan' }}</h3>
      </div>
    </a>
    @empty
    {{-- Contoh Kartu jika data kosong --}}
    <a href="#" class="layanan-card-link-v2">
      <div class="layanan-card-v2">
        <i class="fas fa-info-circle layanan-icon-v2"></i>
        <h3 class="layanan-nama-v2">Info Camaba</h3>
      </div>
    </a>
    <a href="#" class="layanan-card-link-v2">
      <div class="layanan-card-v2">
        <i class="fas fa-user-graduate layanan-icon-v2"></i>
        <h3 class="layanan-nama-v2">Tracer Study</h3>
      </div>
    </a>
    <a href="#" class="layanan-card-link-v2">
      <div class="layanan-card-v2">
        <i class="fas fa-university layanan-icon-v2"></i>
        <h3 class="layanan-nama-v2">SIAKAD</h3>
      </div>
    </a>
    @endforelse
  </div>
</section>

@endsection