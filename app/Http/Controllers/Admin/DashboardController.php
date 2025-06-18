<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Hki;
use App\Models\ProgramStudi;
use App\Models\TenagaKependidikan;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari masing-masing model
        $jumlahBerita = Berita::count();
        $jumlahDosen = Dosen::count();
        $jumlahTendik = TenagaKependidikan::count();
        $jumlahProdi = ProgramStudi::count();
        $jumlahHki = Hki::count();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'jumlahBerita',
            'jumlahDosen',
            'jumlahTendik',
            'jumlahProdi',
            'jumlahHki'
        ));
    }
}