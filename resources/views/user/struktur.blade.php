@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Struktur Organisasi --}}
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

  .struktur-section-v2 {
    font-family: 'Poppins', sans-serif;
    width: 100%;
    padding: 20px 20px;
    background-color: #ffffff;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .struktur-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .struktur-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 50px auto;
    border: none;
  }

  .struktur-container-v2 {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    text-align: center;
  }

  .struktur-image-v2 {
    width: 100%;
    /* [PERBAIKAN] Diubah menjadi 100% agar mengisi kontainer */
    height: auto;
    border-radius: 10px;
    object-fit: contain;
  }

  /* Media Query untuk penyesuaian di layar kecil */
  @media (max-width: 768px) {
    .struktur-section-v2 {
      padding: 40px 15px;
    }

    .struktur-title-v2 {
      font-size: 2rem;
    }

    .struktur-container-v2 {
      padding: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="struktur-section-v2">
  <h2 class="struktur-title-v2">Struktur Organisasi</h2>
  <hr class="struktur-line-v2" />

  <div class="struktur-container-v2">
    @if(isset($struktur) && $struktur->gambar)
    {{-- Jika ada data struktur dan gambar, tampilkan gambar dari storage --}}
    <img src="{{ asset('storage/' . $struktur->gambar) }}" alt="Struktur Organisasi Fakultas" class="struktur-image-v2">
    @else
    {{-- Jika tidak ada gambar, tampilkan placeholder --}}
    <img src="https://placehold.co/1200x800/f8f9fa/333?text=Gambar+Struktur+Organisasi"
      alt="Struktur Organisasi Fakultas" class="struktur-image-v2">
    @endif
  </div>
</section>

@endsection