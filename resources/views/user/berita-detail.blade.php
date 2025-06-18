@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Detail Berita --}}
@push('styles')
<style>
    /* Mengimpor Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap');

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    .berita-detail-section {
        font-family: 'Poppins', sans-serif;
        padding: 60px 20px;
        background-color: #ffffff;
        overflow-x: hidden;
    }

    .berita-detail-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .berita-detail-header {
        margin-bottom: 30px;
        text-align: center;
    }

    .berita-detail-line {
        width: 100px;
        height: 4px;
        background-color: #0056b3;
        margin: 20px auto;
        border: none;
    }

    .berita-detail-title {
        font-family: 'Merriweather', serif;
        font-size: 2.5rem;
        /* Ukuran diperkecil */
        font-weight: 700;
        line-height: 1.3;
        color: #333;
        margin: 0 0 15px 0;
    }

    .berita-detail-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .berita-detail-img-wrapper {
        margin-bottom: 40px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .berita-detail-img {
        width: 100%;
        height: auto;
        display: block;
    }

    .berita-detail-content {
        font-family: 'Merriweather', serif;
        font-size: 1.05rem;
        /* Ukuran diperkecil */
        line-height: 1.8;
        color: #444;
    }

    .berita-detail-content p {
        margin-bottom: 1.5em;
    }

    .berita-detail-content a {
        color: #0056b3;
        text-decoration: underline;
    }

    /* [PENAMBAHAN] CSS untuk Berita Terbaru */
    .berita-terbaru-section {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid #e9ecef;
    }

    .berita-terbaru-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    .berita-terbaru-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .berita-terbaru-item {
        color: #333;
        text-decoration: none;
        display: block;
    }

    .berita-terbaru-item:hover .berita-terbaru-item-title {
        color: #0056b3;
    }

    .berita-terbaru-img {
        width: 100%;
        height: 130px;
        /* Ukuran diperkecil */
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .berita-terbaru-item-title {
        font-family: 'Poppins', sans-serif;
        font-size: 0.95rem;
        /* Ukuran diperkecil */
        font-weight: 600;
        line-height: 1.4;
        transition: color 0.3s ease;
    }


    @media (max-width: 768px) {
        .berita-detail-section {
            padding: 40px 15px;
        }

        .berita-detail-title {
            font-size: 1.8rem;
            /* Ukuran diperkecil untuk mobile */
        }

        .berita-detail-content {
            font-size: 1rem;
        }
    }
</style>
@endpush

@section('isi')

<article class="berita-detail-section">
    <div class="berita-detail-container">
        <header class="berita-detail-header">
            <h1 class="berita-detail-title">{{ $berita->judul }}</h1>
            <p class="berita-detail-meta">
                Dipublikasikan pada {{ \Carbon\Carbon::parse($berita->published_at)->isoFormat('dddd, D MMMM YYYY') }}
            </p>
            <hr class="berita-detail-line" />
        </header>

        @if($berita->gambar)
        <div class="berita-detail-img-wrapper">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-detail-img">
        </div>
        @endif

        <div class="berita-detail-content">
            {!! $berita->konten !!}
        </div>

        {{-- Bagian Berita Terbaru --}}
        @if(isset($beritaTerbaru) && $beritaTerbaru->isNotEmpty())
        <div class="berita-terbaru-section">
            <h2 class="berita-terbaru-title">Baca Juga Berita Lainnya</h2>
            <div class="berita-terbaru-grid">
                @foreach ($beritaTerbaru as $item)
                <a href="{{ route('detail-berita', $item) }}" class="berita-terbaru-item">
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                        class="berita-terbaru-img">
                    @else
                    <img src="https://placehold.co/400x300/0056b3/FFFFFF?text=Berita" alt="{{ $item->judul }}"
                        class="berita-terbaru-img">
                    @endif
                    <h3 class="berita-terbaru-item-title">{{ $item->judul }}</h3>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</article>

@endsection