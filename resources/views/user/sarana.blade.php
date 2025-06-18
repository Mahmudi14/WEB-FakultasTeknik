@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Sarana & Prasarana --}}
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

  .sarana-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .sarana-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .sarana-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  .sarana-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .sarana-card-v2 {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    /* Penting untuk efek overlay dan gambar */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 220px;
    /* Ukuran kartu diperkecil */
    background-color: #ffffff;
    /* Warna latar belakang untuk gambar 'contain' */
  }

  .sarana-card-v2:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0, 86, 179, 0.15);
  }

  .sarana-card-v2:hover .sarana-img-v2 {
    transform: scale(1.05);
    /* Efek zoom pada gambar saat hover */
  }

  .sarana-img-v2 {
    width: 100%;
    height: 100%;
    object-fit: contain;
    /* Diubah agar seluruh gambar terlihat */
    transition: transform 0.3s ease;
    padding: 10px;
    /* Memberi sedikit padding pada gambar */
  }

  .sarana-info-overlay-v2 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    text-align: left;
    color: #ffffff;
  }

  .sarana-name-v2 {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0;
  }

  /* Media Query untuk penyesuaian di layar kecil */
  @media (max-width: 768px) {
    .sarana-section-v2 {
      padding: 40px 15px;
    }

    .sarana-title-v2 {
      font-size: 2rem;
    }

    .sarana-grid-v2 {
      gap: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="sarana-section-v2">
  <h2 class="sarana-title-v2">Sarana & Prasarana</h2>
  <hr class="sarana-line-v2" />

  <div class="sarana-grid-v2">
    {{-- Asumsi $saranas adalah koleksi yang dikirim dari controller --}}
    @forelse ($saranas as $sarana)
    <a href="{{ asset('storage/' . $sarana->gambar) }}" data-lightbox="sarana-prasarana"
      data-title="{{ $sarana->nama }}">
      <div class="sarana-card-v2">
        @if($sarana->gambar)
        <img src="{{ asset('storage/' . $sarana->gambar) }}" alt="{{ $sarana->nama }}" class="sarana-img-v2">
        @else
        <img src="https://placehold.co/600x400/6c757d/FFFFFF?text=Gambar+Sarana" alt="{{ $sarana->nama }}"
          class="sarana-img-v2">
        @endif
        <div class="sarana-info-overlay-v2">
          <h3 class="sarana-name-v2">{{ $sarana->nama ?? 'Nama Sarana' }}</h3>
        </div>
      </div>
    </a>
    @empty
    {{-- Contoh Kartu jika data kosong --}}
    @for ($i = 0; $i < 6; $i++) <a href="#">
      <div class="sarana-card-v2">
        <img src="https://placehold.co/600x400/343a40/FFFFFF?text=Contoh+Sarana" alt="Contoh Sarana"
          class="sarana-img-v2">
        <div class="sarana-info-overlay-v2">
          <h3 class="sarana-name-v2">Nama Fasilitas</h3>
        </div>
      </div>
      </a>
      @endfor
      @endforelse
  </div>
</section>

@endsection

{{-- Jika Anda ingin fitur zoom (Lightbox2), tambahkan scriptnya di master layout --}}
@push('scripts')

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>

@endpush