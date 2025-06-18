@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Daftar Berita --}}
@push('styles')
<style>
  /* Mengimpor Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .berita-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
  }

  .berita-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .berita-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 50px auto;
    border: none;
  }

  .berita-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .berita-card-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
  }

  .berita-card-v2:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 86, 179, 0.12);
  }

  .berita-img-link-v2 {
    display: block;
    height: 220px;
    overflow: hidden;
  }

  .berita-img-v2 {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .berita-card-v2:hover .berita-img-v2 {
    transform: scale(1.05);
  }

  .berita-content-v2 {
    padding: 25px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .berita-meta-v2 {
    /* [PERUBAHAN] Dibuat rata ke kanan karena hanya ada tanggal */
    text-align: right;
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 15px;
  }

  /* Dihapus karena tidak lagi menampilkan kategori
    .berita-kategori-v2 { ... }
    */

  .berita-judul-v2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 10px 0;
    line-height: 1.4;
  }

  .berita-excerpt-v2 {
    font-size: 0.95rem;
    color: #555;
    line-height: 1.6;
    flex-grow: 1;
    margin-bottom: 20px;
  }

  .berita-selengkapnya-v2 {
    margin-top: auto;
    color: #0056b3;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .berita-selengkapnya-v2 .arrow {
    transition: transform 0.2s ease;
  }

  .berita-selengkapnya-v2:hover .arrow {
    transform: translateX(5px);
  }

  .berita-pagination-v2 {
    margin-top: 50px;
    display: flex;
    justify-content: center;
  }

  @media (max-width: 768px) {
    .berita-section-v2 {
      padding: 40px 15px;
    }

    .berita-title-v2 {
      font-size: 2rem;
    }

    .berita-grid-v2 {
      gap: 20px;
    }
  }
</style>
@endpush

@section('isi')

<section class="berita-section-v2">
  {{-- [PERUBAHAN] Judul disesuaikan --}}
  <h2 class="berita-title-v2">Pengumuman</h2>
  <hr class="berita-line-v2" />

  <div class="berita-grid-v2">
    {{-- Asumsi variabel $beritas dari controller sudah difilter dan hanya berisi berita --}}
    @forelse ($beritas as $berita)
    <div class="berita-card-v2">
      <a href="{{ url('/berita/' . $berita->slug) }}" class="berita-img-link-v2">
        @if($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-img-v2">
        @else
        <img src="https://placehold.co/600x400/0056b3/FFFFFF?text=Berita" alt="{{ $berita->judul }}"
          class="berita-img-v2">
        @endif
      </a>
      <div class="berita-content-v2">
        <div class="berita-meta-v2">
          {{-- [PERUBAHAN] Span kategori dihapus --}}
          <span>{{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}</span>
        </div>
        <h3 class="berita-judul-v2">
          <a href="{{ url('/berita/' . $berita->slug) }}" style="text-decoration:none; color:inherit;">
            {{ $berita->judul }}
          </a>
        </h3>
        <p class="berita-excerpt-v2">
          {{ Str::limit(strip_tags($berita->konten), 120) }}
        </p>
        <a href="{{ route('detail-berita',$berita) }}" class="berita-selengkapnya-v2">
          <span>Baca Selengkapnya</span>
          <span class="arrow">&rarr;</span>
        </a>
      </div>
    </div>
    @empty
    <p class="text-muted">Belum ada berita yang dipublikasikan.</p>
    @endforelse
  </div>

  {{-- Tautan Paginasi --}}
  <div class="berita-pagination-v2">
    {{-- {{ $beritas->links() }} --}}
  </div>
</section>

@endsection