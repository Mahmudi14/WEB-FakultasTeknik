@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Tenaga Kependidikan --}}
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

  .tendik-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #ffffff;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .tendik-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .tendik-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    /* Warna biru khas universitas */
    margin: 0 auto 50px auto;
    border: none;
  }

  .tendik-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 25px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .tendik-card-v2 {
    background-color: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid #e9ecef;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .tendik-card-v2:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 86, 179, 0.1);
  }

  .tendik-img-wrapper-v2 {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    /* Mencegah gambar menyusut */
    border: 3px solid #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .tendik-img-v2 {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .tendik-info-v2 {
    display: flex;
    flex-direction: column;
  }

  .tendik-nama-v2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .tendik-jabatan-v2 {
    font-size: 1rem;
    font-weight: 400;
    color: #0056b3;
    margin: 2px 0 5px 0;
  }

  .tendik-unit-v2 {
    font-size: 0.9rem;
    font-weight: 300;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .tendik-unit-v2 i {
    font-size: 0.8rem;
  }

  /* Media Query untuk penyesuaian di layar kecil */
  @media (max-width: 768px) {
    .tendik-section-v2 {
      padding: 40px 15px;
    }

    .tendik-title-v2 {
      font-size: 2rem;
    }

    .tendik-grid-v2 {
      gap: 15px;
    }
  }
</style>
@endpush

@section('isi')

<section class="tendik-section-v2">
  <h2 class="tendik-title-v2">Tenaga Kependidikan</h2>
  <hr class="tendik-line-v2" />

  <div class="tendik-grid-v2">
    {{-- Asumsi $tendiks adalah koleksi yang dikirim dari controller --}}
    @forelse ($tendiks as $tendik)
    <div class="tendik-card-v2">
      <div class="tendik-img-wrapper-v2">
        @if($tendik->gambar)
        <img src="{{ asset('storage/' . $tendik->gambar) }}" alt="Foto {{ $tendik->nama }}" class="tendik-img-v2">
        @else
        <img src="https://placehold.co/150x150/6c757d/FFFFFF?text=Foto" alt="Foto Tenaga Kependidikan"
          class="tendik-img-v2">
        @endif
      </div>
      <div class="tendik-info-v2">
        <h3 class="tendik-nama-v2">{{ $tendik->nama ?? 'Nama Staf' }}</h3>
        <p class="tendik-jabatan-v2">{{ $tendik->jabatan ?? 'Jabatan' }}</p>
        <div class="tendik-unit-v2">
          <i class="fas fa-briefcase"></i>
          <span>{{ $tendik->unit_kerja ?? 'Unit Kerja' }}</span>
        </div>
      </div>
    </div>
    @empty
    {{-- Contoh Kartu jika data kosong --}}
    @for ($i = 0; $i < 4; $i++) <div class="tendik-card-v2">
      <div class="tendik-img-wrapper-v2">
        <img src="https://placehold.co/150x150/6c757d/FFFFFF?text=Foto" alt="Foto Tenaga Kependidikan"
          class="tendik-img-v2">
      </div>
      <div class="tendik-info-v2">
        <h3 class="tendik-nama-v2">Nama Staf</h3>
        <p class="tendik-jabatan-v2">Jabatan Staf</p>
        <div class="tendik-unit-v2">
          <i class="fas fa-briefcase"></i>
          <span>Unit Kerja</span>
        </div>
      </div>
  </div>
  @endfor
  @endforelse
  </div>
</section>

@endsection