<aside class="app-sidebar bg-biru-fakultas">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <img src="{{ asset('assets/img/LOGO UNSULBAR.png') }}" alt="Logo GenBI Unsulbar"
                class="brand-image opacity-75 shadow" />
            <div class="brand-text-wrapper">
                <span class="brand-text-line1">FAKULTAS TEKNIK</span>
                <span class="brand-text-line2">UNIVERSITAS SULAWESI BARAT</span>
            </div>
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}" class="nav-link">
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header nav-sidebar">Manajemen Berita</li>
                <li class="nav-item">
                    <a href="{{ route('admin-berita') }}" class="nav-link">
                        <p>Berita</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-kategori.index') }}" class="nav-link">
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-header nav-sidebar">Manajemen Web</li>
                <li class="nav-item">
                    <a href="{{ route('admin-home') }}" class="nav-link">
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Profil Fakultas
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-sejarah') }}" class="nav-link">
                                <p>Sejarah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-visi-misi') }}" class="nav-link">
                                <p>Visi Misi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-pimpinan') }}" class="nav-link">
                                <p>Pimpinan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-struktur') }}" class="nav-link">
                                <p>Struktur</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Akademik
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-program-studi') }}" class="nav-link">
                                <p>Program Studi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-kalender') }}" class="nav-link">
                                <p>Kalender Akademik</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Sumber Daya
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-dosen') }}" class="nav-link">
                                <p>Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-tenaga-kependidikan') }}" class="nav-link">
                                <p>Tenaga Kependidikan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-sarana') }}" class="nav-link">
                                <p>Sarana & Prasarana</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Kemahasiswaan
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-peraturan') }}" class="nav-link">
                                <p>Peraturan Kemahasiswaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin-grup') }}" class="nav-link">
                                <p>Grup Alumni FT</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            Tri Dharma
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin-hki') }}" class="nav-link">
                                <p>Hak Kekayaan Intelektual</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-layanan') }}" class="nav-link">
                        <p>
                            Layanan Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('https://drive.google.com/file/d/1b-Bki1jcmN5nudTUYw78K6IlDpTXRhTC/view?usp=sharing') }}"
                        target="_blank" class="nav-link">
                        <p>
                            Bantuan
                        </p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>