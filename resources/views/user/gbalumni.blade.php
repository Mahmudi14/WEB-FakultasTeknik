@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Grup Alumni --}}
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

  .alumni-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .alumni-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .alumni-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  .alumni-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .alumni-card-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid #e9ecef;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .alumni-card-v2:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 86, 179, 0.1);
  }

  .alumni-icon-v2 {
    font-size: 3rem;
    flex-shrink: 0;
  }

  .alumni-icon-v2.whatsapp {
    color: #25D366;
  }

  .alumni-icon-v2.facebook {
    color: #1877F2;
  }

  .alumni-icon-v2.telegram {
    color: #2AABEE;
  }

  .alumni-icon-v2.default {
    color: #6c757d;
  }


  .alumni-info-v2 {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .alumni-nama-v2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 5px 0;
  }

  .alumni-platform-v2 {
    font-size: 0.9rem;
    font-weight: 400;
    color: #6c757d;
  }

  .alumni-join-btn-v2 {
    margin-left: auto;
    padding: 10px 20px;
    border-radius: 50px;
    background-color: #0056b3;
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
    white-space: nowrap;
    transition: background-color 0.3s ease;
  }

  .alumni-join-btn-v2:hover {
    background-color: #004488;
  }

  @media (max-width: 768px) {
    .alumni-section-v2 {
      padding: 40px 15px;
    }

    .alumni-title-v2 {
      font-size: 2rem;
    }

    .alumni-grid-v2 {
      gap: 15px;
    }

    .alumni-card-v2 {
      flex-direction: column;
      text-align: center;
    }

    .alumni-join-btn-v2 {
      margin-left: 0;
      margin-top: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="alumni-section-v2">
  <h2 class="alumni-title-v2">Grup Alumni FT</h2>
  <hr class="alumni-line-v2" />

  <div class="alumni-grid-v2">
    {{-- Asumsi $alumniGroups adalah koleksi yang dikirim dari controller --}}
    @forelse ($alumniGroups as $grup)
    <div class="alumni-card-v2">
      @php
      $platform = strtolower($grup->platform);
      $iconClass = 'fas fa-users'; // Default icon
      $iconColor = 'default';

      if ($platform == 'whatsapp') {
      $iconClass = 'fab fa-whatsapp';
      $iconColor = 'whatsapp';
      } elseif ($platform == 'facebook') {
      $iconClass = 'fab fa-facebook';
      $iconColor = 'facebook';
      } elseif ($platform == 'telegram') {
      $iconClass = 'fab fa-telegram-plane';
      $iconColor = 'telegram';
      }
      @endphp
      <i class="alumni-icon-v2 {{ $iconClass }} {{ $iconColor }}"></i>

      <div class="alumni-info-v2">
        <h3 class="alumni-nama-v2">{{ $grup->nama_grup ?? 'Nama Grup' }}</h3>
        <p class="alumni-platform-v2">{{ $grup->platform ?? 'Platform' }}</p>
      </div>
      <a href="{{ $grup->link ?? '#' }}" target="_blank" class="alumni-join-btn-v2">Bergabung</a>
    </div>
    @empty
    {{-- Contoh Kartu jika data kosong --}}
    @for ($i = 0; $i < 3; $i++) <div class="alumni-card-v2">
      <i class="alumni-icon-v2 fab fa-whatsapp whatsapp"></i>
      <div class="alumni-info-v2">
        <h3 class="alumni-nama-v2">Grup Alumni Angkatan 202X</h3>
        <p class="alumni-platform-v2">WhatsApp</p>
      </div>
      <a href="#" target="_blank" class="alumni-join-btn-v2">Bergabung</a>
  </div>
  @endfor
  @endforelse
  </div>
</section>

@endsection