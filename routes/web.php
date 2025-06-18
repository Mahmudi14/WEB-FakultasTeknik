<?php

use App\Http\Controllers\Admin\Akademik\KalenderAkademikController;
use App\Http\Controllers\Admin\Akademik\ProgramStudiController;
use App\Http\Controllers\Admin\Berita\BeritaController;
use App\Http\Controllers\Admin\Berita\KategoriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HalamanUtamaController;
use App\Http\Controllers\Admin\Kemahasiswaan\GrupAlumniController;
use App\Http\Controllers\Admin\Kemahasiswaan\PeraturanKemahasiswaanController;
use App\Http\Controllers\Admin\Layanan\LayananKemahasiswaanController;
use App\Http\Controllers\Admin\Profil\PimpinanController;
use App\Http\Controllers\Admin\Profil\SejarahController;
use App\Http\Controllers\Admin\Profil\StrukturController;
use App\Http\Controllers\Admin\Profil\VisiMisiController;
use App\Http\Controllers\Admin\SumberDaya\DosenController;
use App\Http\Controllers\Admin\SumberDaya\SaranaPrasaranaController;
use App\Http\Controllers\Admin\SumberDaya\TenagaKependidikanController;
use App\Http\Controllers\Admin\TriDarma\HkiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sejara', [HomeController::class, 'sejara'])->name('sejara');
Route::get('/visimisi', [HomeController::class, 'visimisi'])->name('visimisi');
Route::get('/pimpinan', [HomeController::class, 'pimpinan'])->name('pimpinan');
Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');
Route::get('/programstudi', [HomeController::class, 'programstudi'])->name('programstudi');
Route::get('/kalender', [HomeController::class, 'kalender'])->name('kalender');
Route::get('/tenagapendidik', [HomeController::class, 'tenagapendidik'])->name('tenagapendidik');
Route::get('/dosen', [HomeController::class, 'dosen'])->name('Dosen');
Route::get('/sarana', [HomeController::class, 'sarana'])->name('Sarana');
Route::get('/pengumuman', [HomeController::class, 'pengumuman'])->name('pengumuman');
Route::get('/peraturan', [HomeController::class, 'peraturan'])->name('peraturan');
Route::get('/gbalumni', [HomeController::class, 'gbalumni'])->name('Grup Alumni FT');
Route::get('/tridarma', [HomeController::class, 'tridarma'])->name('Hak Kekayaan Intelektual');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('Layanan');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{berita:slug}', [HomeController::class, 'detailBerita'])->name('detail-berita');


//Admin

use App\Http\Controllers\Auth\RegisterController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin/home', [HalamanUtamaController::class, 'index'])->name('admin-home');
    Route::post('/admin/home', [HalamanUtamaController::class, 'storeOrUpdate'])->name('admin-home.store');

    Route::get('/admin/berita', [BeritaController::class, 'index'])->name('admin-berita');
    Route::get('/admin//berita/create', [BeritaController::class, 'create'])->name('admin-berita.create');
    Route::post('/admin//berita', [BeritaController::class, 'store'])->name('admin-berita.store');
    Route::get('/admin//berita/{berita}/edit', [BeritaController::class, 'edit'])->name('admin-berita.edit');
    Route::put('/admin//berita/{berita}', [BeritaController::class, 'update'])->name('admin-berita.update');
    Route::delete('/admin//berita/{berita}', [BeritaController::class, 'destroy'])->name('admin-berita.destroy');

    Route::prefix('admin/berita')->name('admin-')->group(function () {

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    //
    Route::prefix('profil')
        ->name('admin-')
        ->group(function () {

            // Sejarah
            Route::get('sejarah', [SejarahController::class, 'index'])->name('sejarah');
            Route::post('sejarah', [SejarahController::class, 'storeOrUpdate'])->name('sejarah.store');

            // Visi Misi
            Route::get('visi-misi', [VisiMisiController::class, 'index'])->name('visi-misi');
            Route::post('visi-misi', [VisiMisiController::class, 'storeOrUpdateVisi'])->name('visi.store');
            Route::post('visi-misi/misi', [VisiMisiController::class, 'storeMisi'])->name('misi.store');
            Route::get('visi-misi/misi/{misi}/edit', [VisiMisiController::class, 'editMisi'])->name('misi.edit');
            Route::put('visi-misi/misi/{misi}', [VisiMisiController::class, 'updateMisi'])->name('misi.update');
            Route::delete('visi-misi/misi/{misi}', [VisiMisiController::class, 'destroyMisi'])->name('misi.destroy');

            // Pimpinan
            Route::get('pimpinan', [PimpinanController::class, 'index'])->name('pimpinan');
            Route::post('pimpinan', [PimpinanController::class, 'store'])->name('pimpinan.store');
            Route::get('pimpinan/{pimpinan}/edit', [PimpinanController::class, 'edit'])->name('pimpinan.edit');
            Route::put('pimpinan/{pimpinan}', [PimpinanController::class, 'update'])->name('pimpinan.update');
            Route::delete('pimpinan/{pimpinan}', [PimpinanController::class, 'destroy'])->name('pimpinan.destroy');

            // Sturuktur
            Route::get('struktur', [StrukturController::class, 'index'])->name('struktur');
            Route::post('struktur', [StrukturController::class, 'storeOrUpdate'])->name('struktur.storeOrUpdate');
        });


    Route::prefix('akademik')
        ->name('admin-')
        ->group(function () {

            // Program Studi
            Route::get('program-studi', [ProgramStudiController::class, 'index'])->name('program-studi');
            Route::post('program-studi', [ProgramStudiController::class, 'store'])->name('program-studi.store');
            Route::get('program-studi/{programStudi}/edit', [ProgramStudiController::class, 'edit'])->name('program-studi.edit');
            Route::put('program-studi/{programStudi}', [ProgramStudiController::class, 'update'])->name('program-studi.update');
            Route::delete('program-studi/{programStudi}', [ProgramStudiController::class, 'destroy'])->name('program-studi.destroy');

            Route::get('/kalender-akademik', [KalenderAkademikController::class, 'index'])->name('kalender');
            Route::post('/kalender-akademik', [KalenderAkademikController::class, 'store'])->name('kalender.store');
        });

    Route::prefix('sumberdaya')
        ->name('admin-')
        ->group(function () {

            //Dosen
            Route::get('dosen', [DosenController::class, 'index'])->name('dosen');
            Route::post('dosen', [DosenController::class, 'store'])->name('dosen.store');
            Route::get('dosen/{dosen}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
            Route::put('dosen/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
            Route::delete('dosen/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');

            // Routes untuk Sarana dan Prasarana
            Route::get('sarana', [SaranaPrasaranaController::class, 'index'])->name('sarana');
            Route::post('sarana', [SaranaPrasaranaController::class, 'store'])->name('sarana.store');
            Route::get('sarana/{saranaPrasarana}/edit', [SaranaPrasaranaController::class, 'edit'])->name('sarana.edit');
            Route::put('sarana/{saranaPrasarana}', [SaranaPrasaranaController::class, 'update'])->name('sarana.update');
            Route::delete('sarana/{saranaPrasarana}', [SaranaPrasaranaController::class, 'destroy'])->name('sarana.destroy');

            // Tenaga Kependidikan
            Route::get('tenaga-kependidikan', [TenagaKependidikanController::class, 'index'])->name('tenaga-kependidikan');
            Route::post('tenaga-kependidikan', [TenagaKependidikanController::class, 'store'])->name('tenaga-kependidikan.store');
            Route::get('tenaga-kependidikan/{tenagaKependidikan}/edit', [TenagaKependidikanController::class, 'edit'])->name('tenaga-kependidikan.edit');
            Route::put('tenaga-kependidikan/{tenagaKependidikan}', [TenagaKependidikanController::class, 'update'])->name('tenaga-kependidikan.update');
            Route::delete('tenaga-kependidikan/{tenagaKependidikan}', [TenagaKependidikanController::class, 'destroy'])->name('tenaga-kependidikan.destroy');
        });

    Route::prefix('kemahasiswaan')
        ->name('admin-')
        ->group(function () {

            // Routes untuk Grup Alumni
            Route::get('grup', [GrupAlumniController::class, 'index'])->name('grup');
            Route::post('grup', [GrupAlumniController::class, 'store'])->name('grup.store');
            Route::get('grup/{grupAlumni}/edit', [GrupAlumniController::class, 'edit'])->name('grup.edit');
            Route::put('grup/{grupAlumni}', [GrupAlumniController::class, 'update'])->name('grup.update');
            Route::delete('grup/{grupAlumni}', [GrupAlumniController::class, 'destroy'])->name('grup.destroy');

            // Routes untuk Peraturan Kemahasiswaan
            Route::get('peraturan', [PeraturanKemahasiswaanController::class, 'index'])->name('peraturan');
            Route::post('peraturan', [PeraturanKemahasiswaanController::class, 'store'])->name('peraturan.store');
            Route::get('peraturan/{peraturanKemahasiswaan}/edit', [PeraturanKemahasiswaanController::class, 'edit'])->name('peraturan.edit');
            Route::put('peraturan/{peraturanKemahasiswaan}', [PeraturanKemahasiswaanController::class, 'update'])->name('peraturan.update');
            Route::delete('peraturan/{peraturanKemahasiswaan}', [PeraturanKemahasiswaanController::class, 'destroy'])->name('peraturan.destroy');
        });

    Route::prefix('tridarma')
        ->name('admin-')
        ->group(function () {

            // Routes untuk HKI
            Route::get('hki', [HkiController::class, 'index'])->name('hki');
            Route::post('hki', [HkiController::class, 'store'])->name('hki.store');
            Route::get('hki/{hki}/edit', [HkiController::class, 'edit'])->name('hki.edit');
            Route::put('hki/{hki}', [HkiController::class, 'update'])->name('hki.update');
            Route::delete('hki/{hki}', [HkiController::class, 'destroy'])->name('hki.destroy');
        });

    Route::get('layanan-kemahasiswaan', [LayananKemahasiswaanController::class, 'index'])
        ->name('admin-layanan');
    Route::post('layanan-kemahasiswaan', [LayananKemahasiswaanController::class, 'store'])
        ->name('admin-layanan.store');
    Route::get('layanan-kemahasiswaa/{layanan}/edit', [LayananKemahasiswaanController::class, 'edit'])
        ->name('admin-layanan.edit');
    Route::put('layanan-kemahasiswaan/{layanan}', [LayananKemahasiswaanController::class, 'update'])
        ->name('admin-layanan.update');
    Route::delete('layanan-kemahasiswaan/{layanan}', [LayananKemahasiswaanController::class, 'destroy'])
        ->name('admin-layanan.destroy');
});