<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dosen;
use App\Models\GrupAlumni;
use App\Models\HalamanUtama;
use App\Models\Hki;
use App\Models\KalenderAkademik;
use App\Models\LayananKemahasiswaan;
use App\Models\Misi;
use App\Models\PeraturanKemahasiswaan;
use App\Models\Pimpinan;
use App\Models\ProgramStudi;
use App\Models\SaranaPrasarana;
use App\Models\Sejarah;
use App\Models\Struktur;
use App\Models\TenagaKependidikan;
use App\Models\Visi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dekan = Pimpinan::where('jabatan', 'Dekan')->first();
        $halamanUtama = HalamanUtama::first();
        $prodis = ProgramStudi::all();
        $beritas = Berita::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();
        return view('user/index', compact('prodis', 'beritas', 'halamanUtama', 'dekan'));
    }

    public function sejara()
    {
        $sarana = SaranaPrasarana::first();
        $sejarah = Sejarah::first();
        return view('user/sejara', compact('sejarah', 'sarana'));
    }

    public function visimisi()
    {
        $visi = Visi::first();
        $misi = Misi::orderBy('id', 'asc')->get();;
        return view('user/visimisi', compact('visi', 'misi'));
    }

    public function pimpinan()
    {
        $pimpinans = Pimpinan::all();
        return view('user/pimpinan', compact('pimpinans'));
    }

    public function struktur()
    {
        $struktur = Struktur::first();
        return view('user/struktur', compact('struktur'));
    }

    public function programstudi()
    {
        $prodis = ProgramStudi::all();
        return view('user/programstudi', compact('prodis'));
    }

    public function kalender()
    {
        $kalender = KalenderAkademik::first();
        return view('user/kalender', compact('kalender'));
    }

    public function tenagapendidik()
    {
        $tendiks = TenagaKependidikan::all();
        return view('user/tenagapendidik', compact('tendiks'));
    }

    public function dosen()
    {
        $dosens = Dosen::all();
        return view('user/dosen', compact('dosens'));
    }

    public function sarana()
    {
        $saranas = SaranaPrasarana::all();
        return view('user/sarana', compact('saranas'));
    }

    public function pengumuman()
    {
        $beritas = Berita::whereHas('kategoris', function ($query) {
            $query->where('nama', 'Pengumuman');
        })
            ->where('status', 'published') // Tetap filter hanya yang sudah di-publish
            ->latest('published_at')       // Urutkan dari yang terbaru
            ->paginate(9);
        return view('user/pengumuman', compact('beritas'));
    }

    public function peraturan()
    {
        $peraturans = PeraturanKemahasiswaan::all();
        return view('user/peraturan', compact('peraturans'));
    }

    public function gbalumni()
    {
        $alumniGroups = GrupAlumni::all();
        return view('user/gbalumni', compact('alumniGroups'));
    }

    public function tridarma()
    {
        $hki_list = Hki::with('pemilik')->latest('tanggal_pendaftaran')->paginate(15); // Anda bisa sesuaikan jumlah paginasi

        return view('user/tridarma', compact('hki_list'));
    }

    public function layanan()
    {
        $layanans = LayananKemahasiswaan::all();
        return view('user/layanan', compact('layanans'));
    }
    public function berita()
    {
        $beritas = Berita::whereHas('kategoris', function ($query) {
            // Filter di dalam relasi: cari kategori yang namanya persis 'Berita'
            $query->where('nama', 'Berita');
        })
            ->where('status', 'published') // Tetap filter hanya yang sudah di-publish
            ->latest('published_at')
            ->paginate(9);
        return view('user/berita', compact('beritas'));
    }

    public function detailBerita(Berita $berita)
    {
        // 1. Cek dulu apakah berita yang sedang dibuka adalah 'Pengumuman'
        $isPengumuman = $berita->kategoris()->where('nama', 'Pengumuman')->exists();

        // 2. Siapkan variabel $beritaTerbaru sebagai koleksi kosong
        $beritaTerbaru = collect();

        // 3. HANYA JIKA berita yang dibuka BUKAN 'Pengumuman',
        //    maka kita cari berita terkait lainnya.
        if (!$isPengumuman) {
            $beritaTerbaru = Berita::whereDoesntHave('kategoris', function ($query) {
                // Jangan ikutkan berita yang kategorinya 'Pengumuman'
                $query->where('nama', 'Pengumuman');
            })
                ->where('status', 'published')
                ->where('id', '!=', $berita->id) // Jangan tampilkan berita yang sedang dibaca
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        return view('user.berita-detail', compact('berita', 'beritaTerbaru'));
    }
}