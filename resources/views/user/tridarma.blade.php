@extends('user.master')

{{-- Menambahkan CSS Kustom untuk Tampilan HKI --}}
@push('styles')
<style>
  /* Mengimpor Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .hki-section-v2 {
    font-family: 'Poppins', sans-serif;
    padding: 20px 20px;
    background-color: #f8f9fa;
    overflow-x: hidden;
    /* Mencegah scroll horizontal */
  }

  .hki-title-v2 {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #333;
  }

  .hki-line-v2 {
    width: 100px;
    height: 4px;
    background-color: #0056b3;
    margin: 0 auto 50px auto;
    border: none;
  }

  .hki-table-container-v2 {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    overflow-x: auto;
    /* Membuat tabel bisa di-scroll horizontal di layar kecil */
    max-width: 1200px;
    margin: 0 auto;
  }

  .hki-table-v2 {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
  }

  .hki-table-v2 th,
  .hki-table-v2 td {
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
  }

  .hki-table-v2 thead th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
    text-transform: uppercase;
    font-size: 0.9rem;
    white-space: nowrap;
  }

  .hki-table-v2 tbody tr:last-child td {
    border-bottom: none;
  }

  .hki-table-v2 tbody tr:hover {
    background-color: #f1f1f1;
  }

  .hki-judul-karya {
    font-weight: 600;
    color: #333;
  }

  .hki-pemilik-list {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }

  .hki-pemilik-list li {
    padding: 2px 0;
  }

  @media (max-width: 768px) {
    .hki-section-v2 {
      padding: 40px 15px;
    }

    .hki-title-v2 {
      font-size: 2rem;
    }
  }
</style>
@endpush

@section('isi')

<section class="hki-section-v2">
  <h2 class="hki-title-v2">Hak Kekayaan Intelektual</h2>
  <hr class="hki-line-v2" />

  <div class="hki-table-container-v2">
    <table class="hki-table-v2">
      <thead>
        <tr>
          <th style="width: 5%;">No</th>
          <th>Judul Karya</th>
          <th>Jenis</th>
          <th>Pemilik</th>
          <th>Tanggal Pendaftaran</th>
        </tr>
      </thead>
      <tbody>
        {{-- Asumsi $hki_list adalah koleksi yang dikirim dari controller --}}
        @forelse($hki_list as $hki)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td class="hki-judul-karya">{{ $hki->judul_hki }}</td>
          <td>{{ $hki->jenis_hki }}</td>
          <td>
            @if($hki->pemilik->isNotEmpty())
            <ul class="hki-pemilik-list">
              @foreach($hki->pemilik as $p)
              <li>{{ $p->nama_pemilik }}</li>
              @endforeach
            </ul>
            @else
            <span class="text-muted">-</span>
            @endif
          </td>
          <td>{{ \Carbon\Carbon::parse($hki->tanggal_pendaftaran)->format('d F Y') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="5" style="text-align: center; padding: 40px;">
            <p class="text-muted">Belum ada data Hak Kekayaan Intelektual.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</section>

@endsection