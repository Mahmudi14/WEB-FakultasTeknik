@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Kalender Akademik --}}
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

  .calendar-section-v2 {
    font-family: 'Poppins', sans-serif;
    width: 100%;
    padding: 20px 20px;
    background-color: #ffffff;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .calendar-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .calendar-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 50px auto;
    border: none;
  }

  .calendar-container-v2 {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    text-align: center;
  }

  .calendar-image-v2 {
    width: 100%;
    height: auto;
    border-radius: 10px;
    object-fit: contain;
  }

  /* Media Query untuk penyesuaian di layar kecil */
  @media (max-width: 768px) {
    .calendar-section-v2 {
      padding: 40px 15px;
    }

    .calendar-title-v2 {
      font-size: 2rem;
    }

    .calendar-container-v2 {
      padding: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="calendar-section-v2">
  <h2 class="calendar-title-v2">Kalender Akademik</h2>
  <hr class="calendar-line-v2" />

  <div class="calendar-container-v2">
    @if(isset($kalender) && $kalender->gambar)
    {{-- Jika ada data kalender dan gambar, tampilkan gambar dari storage --}}
    <a href="{{ asset('storage/' . $kalender->gambar) }}" data-lightbox="kalender-akademik"
      data-title="Kalender Akademik">
      <img src="{{ asset('storage/' . $kalender->gambar) }}" alt="Kalender Akademik Fakultas" class="calendar-image-v2">
    </a>
    @else
    {{-- Jika tidak ada gambar, tampilkan placeholder --}}
    <img src="https://placehold.co/1200x800/f8f9fa/333?text=Kalender+Akademik+Belum+Tersedia"
      alt="Kalender Akademik Belum Tersedia" class="calendar-image-v2">
    @endif
  </div>
</section>

@endsection

@push('scripts')
{{-- Jika Anda ingin fitur zoom (Lightbox2), jangan lupa aktifkan scriptnya di master layout --}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>

@endpush