@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan Visi & Misi --}}
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

  .visimisi-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .visimisi-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .visimisi-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 40px auto;
    border: none;
  }

  .visimisi-wrapper-v2 {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    max-width: 1200px;
    margin: 0 auto;
  }

  .visimisi-card-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    flex: 1;
    min-width: 320px;
    display: flex;
    flex-direction: column;
  }

  .visimisi-card-header-v2 {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 25px;
    border-bottom: 1px solid #e9ecef;
  }

  .visimisi-icon-v2 {
    font-size: 2rem;
    color: #0056b3;
  }

  .visimisi-card-title-v2 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #333;
    margin: 0;
  }

  .visimisi-card-body-v2 {
    padding: 25px 30px;
    font-size: 1rem;
    line-height: 1.7;
    color: #555;
  }

  .visimisi-card-body-v2 p {
    text-align: justify;
  }

  .visimisi-card-body-v2 ol {
    padding-left: 20px;
    margin: 0;
  }

  .visimisi-card-body-v2 li {
    margin-bottom: 10px;
    text-align: left;
  }

  .visimisi-card-body-v2 li:last-child {
    margin-bottom: 0;
  }

  @media (max-width: 768px) {
    .visimisi-section-v2 {
      padding: 40px 15px;
    }

    .visimisi-title-v2 {
      font-size: 2rem;
    }
  }
</style>
@endpush

@section('isi')

<section class="visimisi-section-v2">
  <h2 class="visimisi-title-v2">Visi & Misi</h2>
  <hr class="visimisi-line-v2" />

  <div class="visimisi-wrapper-v2">
    <!-- Kartu Visi -->
    <div class="visimisi-card-v2">
      <div class="visimisi-card-header-v2">
        <i class="fas fa-eye visimisi-icon-v2"></i>
        <h3 class="visimisi-card-title-v2">VISI</h3>
      </div>
      <div class="visimisi-card-body-v2">
        @if(isset($visi) && $visi->konten)
        <p>{{ $visi->konten }}</p>
        @else
        <p class="text-muted">Belum ada data visi yang ditambahkan.</p>
        @endif
      </div>
    </div>

    <!-- Kartu Misi -->
    <div class="visimisi-card-v2">
      <div class="visimisi-card-header-v2">
        <i class="fas fa-bullseye visimisi-icon-v2"></i>
        <h3 class="visimisi-card-title-v2">MISI</h3>
      </div>
      <div class="visimisi-card-body-v2">
        <ol>
          @forelse ($misi as $mi)
          <li>
            <p>
              {{ $mi->deskripsi_misi }}
            </p>
          </li>
          @empty
          <li>
            <p class="text-muted">Belum ada data misi yang ditambahkan.</p>
          </li>
          @endforelse
        </ol>
      </div>
    </div>
  </div>
</section>

@endsection