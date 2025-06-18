@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Program Studi --}}
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

  .prodi-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    /* Latar belakang sedikit abu-abu */
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .prodi-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .prodi-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  .prodi-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .prodi-card-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px 20px;
    text-align: center;
  }

  .prodi-card-v2:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 86, 179, 0.1);
  }

  .prodi-img-wrapper-v2 {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    /* Membuat gambar menjadi lingkaran */
    overflow: hidden;
    margin-bottom: 25px;
    border: 5px solid #ffffff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
    transition: width 0.3s ease, height 0.3s ease;
    /* Transisi untuk perubahan ukuran */
  }

  .prodi-img-v2 {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Memastikan gambar memenuhi area tanpa distorsi */
  }

  .prodi-info-v2 {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .prodi-koordinator-nama-v2 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
  }

  .prodi-koordinator-label-v2 {
    font-size: 0.9rem;
    font-weight: 400;
    color: #6c757d;
    margin-bottom: 15px;
  }

  .prodi-name-v2 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #0056b3;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding-top: 15px;
    border-top: 1px solid #dee2e6;
    width: 100%;
  }

  /* Penyesuaian Responsif untuk Layar Kecil */
  @media (max-width: 768px) {
    .prodi-section-v2 {
      padding: 40px 15px;
      /* Kurangi padding section */
    }

    .prodi-title-v2 {
      font-size: 2rem;
      /* Perkecil judul utama */
    }

    .prodi-grid-v2 {
      gap: 20px;
      /* Kurangi jarak antar kartu */
    }

    .prodi-card-v2 {
      padding: 30px 20px;
      /* Kurangi padding di dalam kartu */
    }

    .prodi-img-wrapper-v2 {
      width: 120px;
      /* Perkecil ukuran foto */
      height: 120px;
      margin-bottom: 20px;
    }

    .prodi-koordinator-nama-v2 {
      font-size: 1.2rem;
      /* Perkecil font nama */
    }

    .prodi-name-v2 {
      font-size: 1rem;
      /* Perkecil font nama prodi */
    }
  }
</style>
@endpush

@section('isi')

<section class="prodi-section-v2">
  <h2 class="prodi-title-v2">Program Studi</h2>
  <hr class="prodi-line-v2" />

  <div class="prodi-grid-v2">
    {{-- Asumsi $prodis adalah koleksi yang dikirim dari controller --}}
    @forelse ($prodis as $prodi)
    <div class="prodi-card-v2">
      {{-- Bagian Foto Koordinator --}}
      <div class="prodi-img-wrapper-v2">
        @if($prodi->gambar)
        <img src="{{ asset('storage/' . $prodi->gambar) }}" alt="Foto {{ $prodi->koordinator }}" class="prodi-img-v2">
        @else
        <img src="https://placehold.co/400x400/343a40/FFFFFF?text=Foto" alt="Foto Koordinator" class="prodi-img-v2">
        @endif
      </div>

      {{-- Bagian Info --}}
      <div class="prodi-info-v2">
        <h3 class="prodi-koordinator-nama-v2">{{ $prodi->koordinator ?? 'Nama Koordinator' }}</h3>
        <p class="prodi-koordinator-label-v2">Koordinator Program Studi</p>
        <div class="prodi-name-v2">{{ $prodi->program_studi ?? 'Nama Prodi' }}</div>
      </div>
    </div>
    @empty
    {{-- Contoh Kartu jika data kosong --}}
    @for ($i = 0; $i < 3; $i++) <div class="prodi-card-v2">
      <div class="prodi-img-wrapper-v2">
        <img src="https://placehold.co/400x400/343a40/FFFFFF?text=Foto" alt="Foto Koordinator" class="prodi-img-v2">
      </div>
      <div class="prodi-info-v2">
        <h3 class="prodi-koordinator-nama-v2">Nama Koordinator</h3>
        <p class="prodi-koordinator-label-v2">Koordinator Program Studi</p>
        <div class="prodi-name-v2">Nama Program Studi</div>
      </div>
  </div>
  @endfor
  @endforelse
  </div>
</section>

@endsection