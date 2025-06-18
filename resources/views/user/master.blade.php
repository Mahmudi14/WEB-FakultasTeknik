<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fakultas Teknik</title>
  {{--
  <link rel="stylesheet" href="{{ asset('tema/assets/css/main.css') }}"> --}}
  {{-- Menambahkan Font Awesome untuk ikon --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  @stack('styles')

  {{-- CSS untuk Navbar Responsif --}}
  <style>
    /* Mengimpor Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background-color: #f4f4f4;
      padding-top: 70px;
      /* Memberi ruang untuk navbar fixed */
    }

    .main-content {
      max-width: 1200px;
      /* Lebar maksimum konten */
      margin: 30px auto;
      /* Margin atas/bawah dan tengah secara horizontal */
      padding: 0 30px;
      /* Padding kiri/kanan agar konsisten dengan navbar */
      box-sizing: border-box;
    }

    .navbar {
      display: flex;
      justify-content: center;
      /* Memusatkan kontainer di dalamnya */
      align-items: center;
      background-color: #003366;
      padding: 0 30px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      height: 70px;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      box-sizing: border-box;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 15px;
      text-decoration: none;
    }

    .brand-image {
      height: 45px;
      width: auto;
    }

    .brand-text-wrapper {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
    }

    .brand-text-line1 {
      color: #ffffff;
      font-weight: 700;
      font-size: 1rem;
      text-transform: uppercase;
    }

    .brand-text-line2 {
      color: #f0f0f0;
      font-weight: 400;
      font-size: 0.8rem;
      text-transform: uppercase;
    }

    /* [PERBAIKAN] Kontainer untuk membatasi lebar konten navbar */
    .navbar-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      max-width: 1200px;
    }

    .logo {
      font-weight: 600;
      font-size: 1.5rem;
      color: #ffffff;
      flex-shrink: 0;
      /* Mencegah logo menyusut */
    }

    .navbar-collapse {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .nav-links {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
      gap: 10px;
      /* Jarak diperkecil */
    }

    .nav-links li a {
      text-decoration: none;
      color: #f0f0f0;
      padding: 8px 12px;
      /* Padding diperkecil */
      display: block;
      border-radius: 8px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-links li a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: #ffffff;
    }

    .dropdown {
      position: relative;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #003366;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      list-style: none;
      padding: 10px 0;
      margin-top: 1px;
      border-radius: 8px;
      border: 1px solid #004488;
      min-width: 200px;
      z-index: 1000;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    .dropdown-menu li a {
      padding: 10px 20px;
      white-space: nowrap;
      color: #f0f0f0;
    }

    .dropdown-menu li a:hover {
      background-color: #004488;
    }

    .nav-right {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .member-icon {
      cursor: pointer;
      font-size: 0.9rem;
      color: #f0f0f0;
      display: flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
      /* Mencegah teks "Members" pindah baris */
    }

    .search-box {
      border: 1px solid #004488;
      border-radius: 20px;
      padding: 5px 15px;
      font-size: 0.9rem;
      background-color: #002a55;
      color: #ffffff;
      width: 150px;
      /* Memberi lebar tetap */
    }

    .search-box::placeholder {
      color: #ccc;
    }

    .hamburger-menu {
      display: none;
      font-size: 1.8rem;
      cursor: pointer;
      color: #ffffff;
      background: none;
      border: none;
      margin-left: 15px;
    }

    @media (max-width: 1100px) {

      /* Breakpoint diubah agar lebih cepat responsif */
      .hamburger-menu {
        display: block;
      }

      .navbar-collapse {
        visibility: hidden;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease, visibility 0s 0.3s;
        position: absolute;
        top: 70px;
        left: 0;
        width: 100%;
        background-color: #003366;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        flex-direction: column;
        align-items: stretch;
        padding: 10px 0;
        max-height: calc(100vh - 70px);
        overflow-y: auto;
      }

      .navbar-collapse.active {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0s;
      }

      .nav-links {
        flex-direction: column;
        width: 100%;
        gap: 5px;
      }

      .nav-links li {
        width: 100%;
        text-align: left;
      }

      .nav-links li a {
        border-radius: 0;
        padding: 15px 30px;
      }

      .dropdown-menu {
        position: static;
        box-shadow: none;
        border-top: 1px solid #004488;
        margin-top: 0;
        border-radius: 0;
        background-color: #002a55;
        display: none;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease-out;
      }

      .dropdown:hover .dropdown-menu {
        display: none;
      }

      .dropdown>a::after {
        content: '\f078';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        float: right;
        transition: transform 0.3s ease;
      }

      .dropdown.open>a::after {
        transform: rotate(180deg);
      }

      .dropdown.open .dropdown-menu {
        display: block;
        max-height: 500px;
      }

      .nav-right {
        width: 100%;
        padding: 15px 30px;
        border-top: 1px solid #004488;
        justify-content: center;
      }

      .main-content {
        padding: 0 15px;
        margin: 20px auto;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar">
    {{-- [PERBAIKAN] Membungkus konten dengan .navbar-container --}}
    <div class="navbar-container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <img src="{{ asset('assets/img/LOGO UNSULBAR.png') }}" alt="Logo Fakultas Teknik" class="brand-image" />
        <div class="brand-text-wrapper">
          <span class="brand-text-line1">FAKULTAS TEKNIK</span>
          <span class="brand-text-line2">UNIVERSITAS SULAWESI BARAT</span>
        </div>
      </a>

      <div class="navbar-collapse">
        <ul class="nav-links">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="dropdown">
            <a href="#">Profil</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/sejara') }}">Sejarah</a></li>
              <li><a href="{{ url('/visimisi') }}">Visi Misi</a></li>
              <li><a href="{{ url('/pimpinan') }}">Pimpinan</a></li>
              <li><a href="{{ url('/struktur') }}">Struktur</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Akademik</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/programstudi') }}">Program Studi</a></li>
              <li><a href="{{ url('/kalender') }}">Kalender Akademik</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Sumberdaya</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/tenagapendidik') }}">Tenaga Pendidik</a></li>
              <li><a href="{{ url('/sarana') }}">Sarana & Prasarana</a></li>
              <li><a href="{{ url('/dosen') }}">Dosen</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Kemahasiswaan</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/pengumuman') }}">Pengumuman</a></li>
              <li><a href="{{ url('/gbalumni') }}">Grup Alumni FT</a></li>
              <li><a href="{{ url('/peraturan') }}">Peraturan</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Tridarma</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/tridarma') }}">Hak Kekayaan Intelektual</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Lainnya</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/layanan') }}">Layanan</a></li>
              <li><a href="{{ url('/berita') }}">Berita</a></li>
            </ul>
          </li>
          <li><a href="{{ url('/berita') }}">Bantuan</a></li>
        </ul>
      </div>
      <button class="hamburger-menu" aria-label="Toggle Menu">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </nav>

  <main class="main-content">
    @yield('isi')
  </main>

  @stack('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
            // Logika JavaScript tetap sama karena struktur HTML di dalam mobile menu tidak berubah
            const hamburger = document.querySelector('.hamburger-menu');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const dropdownToggles = document.querySelectorAll('.nav-links .dropdown > a');

            hamburger.addEventListener('click', function () {
                navbarCollapse.classList.toggle('active');
            });

            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    if (window.innerWidth <= 1100) {
                        e.preventDefault();
                        const parentLi = this.parentElement;
                        
                        document.querySelectorAll('.nav-links .dropdown.open').forEach(function(openDropdown) {
                            if (openDropdown !== parentLi) {
                                openDropdown.classList.remove('open');
                            }
                        });

                        parentLi.classList.toggle('open');
                    }
                });
            });

            const allLinks = document.querySelectorAll('.navbar-collapse a');
            allLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if(navbarCollapse.classList.contains('active')) {
                        if (!this.parentElement.classList.contains('dropdown')) {
                             navbarCollapse.classList.remove('active');
                        }
                    }
                });
            });

            window.addEventListener('resize', function() {
                if(window.innerWidth > 1100) {
                    navbarCollapse.classList.remove('active');
                     document.querySelectorAll('.nav-links .dropdown.open').forEach(function(openDropdown) {
                        openDropdown.classList.remove('open');
                    });
                }
            });
        });
  </script>
</body>

</html>