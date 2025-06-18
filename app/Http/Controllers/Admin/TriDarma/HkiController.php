<?php

namespace App\Http\Controllers\Admin\TriDarma;

use App\Http\Controllers\Controller;
use App\Models\Hki;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HkiController extends Controller
{
    public function index()
    {

        // Ambil semua HKI DAN data pemilik yang terhubung dengannya
        $hki_list = Hki::with('pemilik')->orderBy('tanggal_pendaftaran', 'desc')->get();
        // Ambil juga daftar pemilik untuk mengisi dropdown di modal tambah
        $pemilik_list = Pemilik::orderBy('nama_pemilik', 'asc')->get();

        return view('admin.tridarma.tridarma-hki', compact('hki_list', 'pemilik_list'));
    }

    public function store(Request $request)
    {
        // --- 1. Validasi Input ---
        // Aturan validasi tidak berubah, tetap menerima 'pemilik_nama' sebagai string.
        $validator = Validator::make($request->all(), [
            'judul_hki'         => 'required|string|max:255',
            'jenis_hki'         => 'required|string|max:255',
            'nomor_pendaftaran' => 'nullable|string|max:255|unique:hki,nomor_pendaftaran',
            'tanggal_pendaftaran' => 'required|date',
            'pemilik_nama'      => 'required|string',
        ], [
            // Pesan error disesuaikan.
            'pemilik_nama.required' => 'Minimal satu nama pemilik harus diisi.'
        ]);

        // Redirect jika validasi gagal, dengan flag untuk membuka kembali modal.
        if ($validator->fails()) {
            return redirect()->route('admin-hki')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true); // Flag ini dipertahankan
        }

        // --- 2. Proses Input Nama Pemilik ---
        $pemilikIds = [];
        // PERUBAHAN: Pisahkan string nama menggunakan titik koma (;) sebagai pemisah.
        $pemilikNames = explode(';', $request->input('pemilik_nama'));

        foreach ($pemilikNames as $nama) {
            // Bersihkan nama dari spasi berlebih di awal/akhir.
            $trimmedNama = trim($nama);

            // Hanya proses jika nama tidak kosong.
            if (!empty($trimmedNama)) {
                // Gunakan firstOrCreate untuk mencari atau membuat pemilik baru.
                $pemilik = Pemilik::firstOrCreate(
                    ['nama_pemilik' => $trimmedNama]
                );
                // Kumpulkan ID pemilik untuk dilampirkan nanti.
                $pemilikIds[] = $pemilik->id;
            }
        }

        // --- 3. Buat Data HKI Utama ---
        $hki = Hki::create([
            'judul_hki' => $request->judul_hki,
            'jenis_hki' => $request->jenis_hki,
            'nomor_pendaftaran' => $request->nomor_pendaftaran,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        // --- 4. Lampirkan Relasi Pemilik ke HKI ---
        // Gunakan sync() untuk melampirkan ID pemilik yang telah dikumpulkan.
        if (!empty($pemilikIds)) {
            $hki->pemilik()->sync($pemilikIds);
        }

        return redirect()->route('admin-hki')->with('success', 'Data HKI berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit HKI.
     */
    public function edit(Hki $hki)
    {
        // Load relasi pemilik untuk HKI yang akan diedit
        $hki->load('pemilik');
        $pemilik_list = Pemilik::orderBy('nama_pemilik', 'asc')->get();

        return view('admin.tridarma.tridarma-hki-edit', compact('hki', 'pemilik_list'));
    }

    /**
     * Memperbarui HKI yang ada di database.
     */
    public function update(Request $request, Hki $hki)
    {
        // --- 1. Validasi Input ---
        $validator = Validator::make($request->all(), [
            'judul_hki'         => 'required|string|max:255',
            'jenis_hki'         => 'required|string|max:255',
            // Pastikan nomor pendaftaran unik, kecuali untuk data HKI yang sedang diedit.
            'nomor_pendaftaran' => 'nullable|string|max:255|unique:hki,nomor_pendaftaran,' . $hki->id,
            'tanggal_pendaftaran' => 'required|date',
            // Validasi input nama dari form, bukan lagi array ID.
            'pemilik_nama'      => 'required|string',
        ], [
            'pemilik_nama.required' => 'Minimal satu nama pemilik harus diisi.'
        ]);

        // Redirect jika validasi gagal.
        if ($validator->fails()) {
            return redirect()->route('admin-hki.edit', $hki->id)
                ->withErrors($validator)
                ->withInput();
        }

        // --- 2. Proses Input Nama Pemilik ---
        $pemilikIds = [];
        // Pisahkan string nama menggunakan titik koma (;) sebagai pemisah.
        $pemilikNames = explode(';', $request->input('pemilik_nama'));

        foreach ($pemilikNames as $nama) {
            $trimmedNama = trim($nama);
            if (!empty($trimmedNama)) {
                // Cari atau buat pemilik baru.
                $pemilik = Pemilik::firstOrCreate(
                    ['nama_pemilik' => $trimmedNama]
                );
                // Kumpulkan ID-nya.
                $pemilikIds[] = $pemilik->id;
            }
        }

        // --- 3. Update Data HKI Utama ---
        $hki->update([
            'judul_hki' => $request->judul_hki,
            'jenis_hki' => $request->jenis_hki,
            'nomor_pendaftaran' => $request->nomor_pendaftaran,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        ]);

        // --- 4. Sinkronkan Relasi Pemilik ---
        // sync() akan secara cerdas menangani penambahan, penghapusan, 
        // dan pemeliharaan relasi yang sudah ada.
        $hki->pemilik()->sync($pemilikIds);

        return redirect()->route('admin-hki')->with('success', 'Data HKI berhasil diperbarui.');
    }

    /**
     * Menghapus HKI dari database.
     */
    public function destroy(Hki $hki)
    {
        // Relasi di tabel pivot akan terhapus secara otomatis karena onDelete('cascade') di migration
        $hki->delete();

        return redirect()->route('admin-hki')->with('success', 'Data HKI berhasil dihapus.');
    }
}