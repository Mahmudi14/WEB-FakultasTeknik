@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Sambutan Dekan dan bagian lainnya --}}
@push('styles')
<style>
  /* Mengimpor Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap');

  .section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 60px 20px;
    overflow-x: hidden;
  }

  .section-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .section-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 50px auto;
    border: none;
  }

  .section-v2.bg-white {
    background-color: #ffffff;
  }

  .section-v2.bg-light {
    background-color: #f8f9fa;
  }

  /* --- Sambutan Dekan --- */
  .sambutan-wrapper-v2 {
    display: grid;
    grid-template-columns: minmax(300px, 1.5fr) minmax(300px, 1fr);
    grid-template-rows: auto 1fr auto;
    grid-template-areas:
      "title image"
      "paragraph image"
      "info image";
    align-items: center;
    gap: 20px 50px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .sambutan-title-v2 {
    grid-area: title;
    font-family: 'Merriweather', serif;
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    line-height: 1.4;
    margin: 0;
  }

  .sambutan-image-container-v2 {
    grid-area: image;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .sambutan-dekan-info-v2 {
    grid-area: info;
    margin-top: 25px;
  }

  .sambutan-paragraf-v2 {
    grid-area: paragraph;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    text-align: justify;
    margin-top: 20px;
  }

  .sambutan-image-v2 {
    width: 100%;
    max-width: 350px;
    height: auto;
    border-radius: 15px;
    object-fit: cover;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
  }

  .sambutan-nama-dekan-v2 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .sambutan-jabatan-dekan-v2 {
    font-size: 1rem;
    color: #0056b3;
  }

  /* --- Program Studi --- */
  .prodi-grid-v2 {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .prodi-card-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    border: 1px solid #e9ecef;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .prodi-card-v2:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 25px rgba(0, 86, 179, 0.1);
  }

  .prodi-icon-v2 {
    font-size: 3rem;
    color: #0056b3;
    margin-bottom: 20px;
  }

  .prodi-name-v2 {
    font-size: 1.4rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 10px 0;
  }

  .prodi-desc-v2 {
    font-size: 0.95rem;
    color: #6c757d;
    line-height: 1.6;
    flex-grow: 1;
    margin-bottom: 20px;
  }

  .prodi-link-v2 {
    margin-top: auto;
    color: #0056b3;
    text-decoration: none;
    font-weight: 600;
  }

  /* --- Berita Terbaru --- */
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
    text-align: right;
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 15px;
  }

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

  .text-center {
    text-align: center;
  }

  .mt-50 {
    margin-top: 50px;
  }

  .btn-lihat-semua {
    display: inline-block;
    padding: 12px 30px;
    background-color: #0056b3;
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }

  .btn-lihat-semua:hover {
    background-color: #004488;
  }

  @media (max-width: 768px) {
    .section-v2 {
      padding: 40px 15px;
    }

    .section-title-v2 {
      font-size: 2rem;
    }

    .sambutan-wrapper-v2 {
      grid-template-columns: 1fr;
      grid-template-areas: "title""image""info""paragraph";
      gap: 25px;
      text-align: center;
    }

    .sambutan-title-v2 {
      font-size: 1.8rem;
    }

    .sambutan-paragraf-v2 {
      text-align: justify;
    }
  }
</style>
@endpush

@section('isi')

{{-- Asumsi variabel dikirim dari Home Controller --}}
@php
// $dekan berisi data dekan dari tabel 'pimpinan'
// $homeSettings berisi data sambutan dari tabel 'halaman_utama'
// $prodis berisi 3-4 prodi unggulan
// $beritas berisi 3 berita terbaru
@endphp

<!-- Bagian Sambutan Dekan -->
<section class="section-v2 bg-white">
  <div class="sambutan-wrapper-v2">

    <h2 class="sambutan-title-v2">{{ $halamanUtama->hero_tittle ?? 'Selamat Datang di Fakultas Teknik Universitas
      Sulawesi Barat'}} </h2>
    <div class="sambutan-image-container-v2">
      @if(isset($dekan) && $dekan->gambar)
      <img src="{{ asset('storage/' . $dekan->gambar) }}" alt="Foto {{ $dekan->nama }}" class="sambutan-image-v2">
      @else
      <img src="https://placehold.co/400x500/003366/FFFFFF?text=Foto+Dekan" alt="Foto Dekan" class="sambutan-image-v2">
      @endif
    </div>
    <div class="sambutan-dekan-info-v2">
      <h4 class="sambutan-nama-dekan-v2">{{ $dekan->nama ?? 'Nama Dekan' }}</h4>
      <p class="sambutan-jabatan-dekan-v2">Dekan Fakultas Teknik</p>
    </div>
    <div class="sambutan-paragraf-v2">
      <p>
        {{ $halamanUtama->sambutan_dekan ?? 'Isi kata sambutan dekan akan ditampilkan di sini. Paragraf ini berisi
        ucapan selamat datang kepada para pengunjung website, baik itu calon mahasiswa, mahasiswa aktif, alumni, maupun
        masyarakat umum. Teks ini dapat diubah melalui panel admin.' }}
      </p>
    </div>
  </div>
</section>

<!-- [PENAMBAHAN] Bagian Program Studi -->
<section class="section-v2 bg-light">
  <h2 class="section-title-v2">Program Studi</h2>
  <hr class="section-line-v2" />
  <div class="prodi-grid-v2">
    @forelse ($prodis as $prodi)
    <div class="prodi-card-v2">
      <i class="fas fa-laptop-code prodi-icon-v2"></i>
      <h3 class="prodi-name-v2">{{ $prodi->program_studi ?? 'Nama Prodi' }}</h3>
      <p class="prodi-desc-v2">Deskripsi singkat tentang program studi {{ $prodi->program_studi ?? '' }}.</p>
      <a href="#" class="prodi-link-v2">Pelajari Selengkapnya &rarr;</a>
    </div>
    @empty
    @for ($i = 0; $i < 3; $i++) <div class="prodi-card-v2">
      <i class="fas fa-laptop-code prodi-icon-v2"></i>
      <h3 class="prodi-name-v2">Contoh Prodi</h3>
      <p class="prodi-desc-v2">Deskripsi singkat tentang contoh program studi, visi, misi, dan prospek karir.</p>
      <a href="#" class="prodi-link-v2">Pelajari Selengkapnya &rarr;</a>
  </div>
  @endfor
  @endforelse
  </div>
  <div class="text-center mt-50">
    <a href="{{ url('/programstudi') }}" class="btn-lihat-semua">Lihat Semua Program Studi</a>
  </div>
</section>

<!-- [PENAMBAHAN] Bagian Berita Terbaru -->
<section class="section-v2 bg-white">
  <h2 class="section-title-v2">Berita & Informasi Terbaru</h2>
  <hr class="section-line-v2" />
  <div class="berita-grid-v2">
    @forelse ($beritas as $berita)
    <div class="berita-card-v2">
      <a href="{{ route('detail-berita', $berita) }}" class="berita-img-link-v2">
        @if($berita->gambar)
        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-img-v2">
        @else
        <img src="https://placehold.co/600x400/0056b3/FFFFFF?text=Berita" alt="{{ $berita->judul }}"
          class="berita-img-v2">
        @endif
      </a>
      <div class="berita-content-v2">
        <div class="berita-meta-v2">
          <span>{{ \Carbon\Carbon::parse($berita->published_at)->format('d F Y') }}</span>
        </div>
        <h3 class="berita-judul-v2">
          <a href="{{ route('detail-berita', $berita) }}" style="text-decoration:none; color:inherit;">
            {{ $berita->judul }}
          </a>
        </h3>
        <p class="berita-excerpt-v2">
          {{ Str::limit(strip_tags($berita->konten), 100) }}
        </p>
        <a href="{{ route('detail-berita', $berita) }}" class="berita-selengkapnya-v2">
          <span>Baca Selengkapnya</span>
          <span class="arrow">&rarr;</span>
        </a>
      </div>
    </div>
    @empty
    @for ($i = 0; $i < 3; $i++) <div class="berita-card-v2">
      <a href="#" class="berita-img-link-v2">
        <img src="https://placehold.co/600x400/0056b3/FFFFFF?text=Berita" alt="Contoh Berita" class="berita-img-v2">
      </a>
      <div class="berita-content-v2">
        <div class="berita-meta-v2"><span>10 Juni 2025</span></div>
        <h3 class="berita-judul-v2"><a href="#" style="text-decoration:none; color:inherit;">Judul Berita atau Informasi
            Penting</a></h3>
        <p class="berita-excerpt-v2">Ini adalah contoh ringkasan singkat dari konten berita yang akan ditampilkan di
          halaman utama.</p>
        <a href="#" class="berita-selengkapnya-v2"><span>Baca Selengkapnya</span><span class="arrow">&rarr;</span></a>
      </div>
  </div>
  @endfor
  @endforelse
  </div>
  <div class="text-center mt-50">
    <a href="{{ route('berita') }}" class="btn-lihat-semua">Lihat Semua Berita</a>
  </div>
</section>

@endsection