@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Pimpinan --}}
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

  .pimpinan-section-v2 {
    font-family: 'Poppins', sans-serif;
    width: 100%;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal yang tidak diinginkan */
  }

  .pimpinan-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .pimpinan-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 50px auto;
    border: none;
  }

  .pimpinan-container-v2 {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
  }

  .pimpinan-card-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%;
    max-width: 280px;
  }

  .pimpinan-card-v2:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 86, 179, 0.2);
  }

  .pimpinan-img-wrapper-v2 {
    width: 100%;
    height: 280px;
    overflow: hidden;
  }

  .pimpinan-img-v2 {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .pimpinan-card-v2:hover .pimpinan-img-v2 {
    transform: scale(1.05);
  }

  .pimpinan-info-v2 {
    padding: 25px 20px;
  }

  .pimpinan-nama-v2 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
  }

  .pimpinan-jabatan-v2 {
    font-size: 0.9rem;
    font-weight: 400;
    color: #0056b3;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .wakil-dekan-container-v2 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    width: 100%;
    max-width: 1000px;
  }

  .wakil-dekan-container-v2 .pimpinan-card-v2 {
    max-width: 240px;
  }

  .wakil-dekan-container-v2 .pimpinan-img-wrapper-v2 {
    height: 240px;
  }

  /* [PERBAIKAN] Media Query untuk Responsif di HP */
  @media (max-width: 768px) {
    .pimpinan-section-v2 {
      padding: 40px 15px;
    }

    .pimpinan-title-v2 {
      font-size: 2rem;
    }

    .wakil-dekan-container-v2 {
      flex-direction: column;
      align-items: center;
      gap: 30px;
    }

    .wakil-dekan-container-v2 .pimpinan-card-v2 {
      max-width: 280px;
    }
  }
</style>
@endpush

@section('isi')
@php
// Asumsi $pimpinans adalah koleksi yang dikirim dari controller
// Ganti 'jabatan' dengan nama kolom yang sesuai di database Anda
$dekan = $pimpinans->firstWhere('jabatan', 'Dekan');
$wd1 = $pimpinans->firstWhere('jabatan', 'Wakil Dekan I');
$wd2 = $pimpinans->firstWhere('jabatan', 'Wakil Dekan II');
$wd3 = $pimpinans->firstWhere('jabatan', 'Wakil Dekan III');
@endphp
<section class="pimpinan-section-v2">
  <h2 class="pimpinan-title-v2">Pimpinan Fakultas</h2>
  <hr class="pimpinan-line-v2" />

  <div class="pimpinan-container-v2">
    <!-- Kartu Dekan (Posisi Utama) -->
    <div class="pimpinan-card-v2">
      <div class="pimpinan-img-wrapper-v2">
        @if($dekan && $dekan->gambar)
        <img src="{{ asset('storage/' . $dekan->gambar) }}" alt="{{ $dekan->nama }}" class="pimpinan-img-v2" />
        @else
        <img src="https://placehold.co/400x500/0056b3/FFFFFF?text=Foto+Dekan" alt="Dekan" class="pimpinan-img-v2" />
        @endif
      </div>
      <div class="pimpinan-info-v2">
        <h3 class="pimpinan-nama-v2">{{ $dekan->nama ?? 'Nama Dekan' }}</h3>
        <p class="pimpinan-jabatan-v2">Dekan</p>
      </div>
    </div>

    <!-- Kontainer untuk Para Wakil Dekan -->
    <div class="wakil-dekan-container-v2">
      <!-- Kartu Wakil Dekan 1 -->
      <div class="pimpinan-card-v2">
        <div class="pimpinan-img-wrapper-v2">
          @if($wd1 && $wd1->gambar)
          <img src="{{ asset('storage/' . $wd1->gambar) }}" alt="{{ $wd1->nama }}" class="pimpinan-img-v2" />
          @else
          <img src="https://placehold.co/400x500/343a40/FFFFFF?text=Foto+WD+1" alt="Wakil Dekan 1"
            class="pimpinan-img-v2" />
          @endif
        </div>
        <div class="pimpinan-info-v2">
          <h3 class="pimpinan-nama-v2">{{ $wd1->nama ?? 'Nama Wakil Dekan I' }}</h3>
          <p class="pimpinan-jabatan-v2">Wakil Dekan I</p>
        </div>
      </div>

      <!-- Kartu Wakil Dekan 2 -->
      <div class="pimpinan-card-v2">
        <div class="pimpinan-img-wrapper-v2">
          @if($wd2 && $wd2->gambar)
          <img src="{{ asset('storage/' . $wd2->gambar) }}" alt="{{ $wd2->nama }}" class="pimpinan-img-v2" />
          @else
          <img src="https://placehold.co/400x500/343a40/FFFFFF?text=Foto+WD+2" alt="Wakil Dekan 2"
            class="pimpinan-img-v2" />
          @endif
        </div>
        <div class="pimpinan-info-v2">
          <h3 class="pimpinan-nama-v2">{{ $wd2->nama ?? 'Nama Wakil Dekan II' }}</h3>
          <p class="pimpinan-jabatan-v2">Wakil Dekan II</p>
        </div>
      </div>

      <!-- Kartu Wakil Dekan 3 -->
      <div class="pimpinan-card-v2">
        <div class="pimpinan-img-wrapper-v2">
          @if($wd3 && $wd3->gambar)
          <img src="{{ asset('storage/' . $wd3->gambar) }}" alt="{{ $wd3->nama }}" class="pimpinan-img-v2" />
          @else
          <img src="https://placehold.co/400x500/343a40/FFFFFF?text=Foto+WD+3" alt="Wakil Dekan 3"
            class="pimpinan-img-v2" />
          @endif
        </div>
        <div class="pimpinan-info-v2">
          <h3 class="pimpinan-nama-v2">{{ $wd3->nama ?? 'Nama Wakil Dekan III' }}</h3>
          <p class="pimpinan-jabatan-v2">Wakil Dekan III</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection