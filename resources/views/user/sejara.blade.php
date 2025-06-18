@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Sejarah --}}
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

  .sejarah-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #ffffff;
    /* Latar belakang putih bersih */
    overflow-x: hidden;
    /* [PERBAIKAN] Mencegah scroll horizontal */
  }

  .sejarah-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .sejarah-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 5px auto;
    border: none;
  }

  .sejarah-wrapper-v2 {
    display: flex;
    flex-wrap: wrap;
    /* Agar responsif */
    align-items: center;
    gap: 40px;
    max-width: 1200px;
    margin: 0 auto;
    background-color: #f8f9fa;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  }

  .sejarah-image-container-v2 {
    flex: 1;
    /* Lebar fleksibel */
    min-width: 300px;
    /* Lebar minimum sebelum pindah baris */
  }

  .sejarah-image-v2 {
    width: 100%;
    height: auto;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  }

  .sejarah-text-container-v2 {
    flex: 1.5;
    /* Memberi lebih banyak ruang untuk teks */
    min-width: 300px;
  }

  .sejarah-paragraf-v2 p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    text-align: justify;
  }

  /* Opsi: Huruf pertama besar untuk sentuhan klasik */
  .sejarah-paragraf-v2 p::first-letter {
    font-size: 3rem;
    font-weight: 600;
    color: #0056b3;
    float: left;
    line-height: 1;
    margin-right: 0.5rem;
    padding-top: 0.2rem;
  }

  @media (max-width: 768px) {
    .sejarah-section-v2 {
      padding: 40px 15px;
    }

    .sejarah-title-v2 {
      font-size: 2rem;
    }

    .sejarah-wrapper-v2 {
      flex-direction: column;
      padding: 25px;
      gap: 30px;
    }

    .sejarah-paragraf-v2 p {
      font-size: 1rem;
      line-height: 1.7;
    }

    .sejarah-paragraf-v2 p::first-letter {
      font-size: 2.5rem;
    }
  }
</style>
@endpush

@section('isi')

<section class="sejarah-section-v2">
  <h2 class="sejarah-title-v2">Sejarah</h2>
  <hr class="sejarah-line-v2" />

  <div class="sejarah-wrapper-v2">
    <!-- Kolom Gambar -->
    <div class="sejarah-image-container-v2">
      {{-- Disarankan menggunakan gambar yang relevan dengan sejarah fakultas --}}
      @if(isset($sarana) && $sarana->gambar)
      <img src="{{ asset('storage/' . $sarana->gambar) }}" alt="Ilustrasi Sejarah Fakultas" class="sejarah-image-v2">
      @else
      <img src="https://placehold.co/800x600/0056b3/FFFFFF?text=Gedung+Pertama" alt="Ilustrasi Sejarah Fakultas"
        class="sejarah-image-v2">
      @endif
    </div>

    <!-- Kolom Teks -->
    <div class="sejarah-text-container-v2">
      <div class="sejarah-paragraf-v2">
        @if(isset($sejarah) && $sejarah->konten)
        <p>{{ $sejarah->konten }}</p>
        @else
        <p class="text-muted">
          Konten sejarah belum ditambahkan. Bagian ini akan menampilkan narasi lengkap mengenai latar belakang
          pendirian, tonggak-tonggak penting, serta perkembangan fakultas dari masa ke masa hingga saat ini.
        </p>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection