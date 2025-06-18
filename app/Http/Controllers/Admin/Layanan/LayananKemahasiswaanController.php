<?php

namespace App\Http\Controllers\Admin\Layanan;

use App\Http\Controllers\Controller;
use App\Models\LayananKemahasiswaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananKemahasiswaanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari model
        $layanan_list = LayananKemahasiswaan::all();
        // Tampilkan view dan kirim data layanan
        return view('admin.layanan.layanan-kemahasiswaan', compact('layanan_list'));
    }

    /**
     * Menyimpan data layanan baru ke database.
     */
    public function store(Request $request)
    {
        // Aturan validasi
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        // Jika validasi gagal, kirim response JSON dengan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Buat record baru
        LayananKemahasiswaan::create($request->only('nama', 'link'));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin-layanan')->with('success', 'Layanan baru berhasil ditambahkan.');
    }


    public function edit(LayananKemahasiswaan $layanan)
    {
        return view('admin.layanan.layanan-kemahasiswaan-edit', ['layanan' => $layanan]);
    }
    /**
     * Memperbarui data layanan yang ada.
     */
    public function update(Request $request, LayananKemahasiswaan $layanan)
    {
        // Aturan validasi
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update record yang ada
        $layanan->update($request->only('nama', 'link'));

        return redirect()->route('admin-layanan')->with('success', 'Layanan berhasil diperbarui.');
    }

    /**
     * Menghapus data layanan dari database.
     */
    public function destroy(LayananKemahasiswaan $layanan)
    {
        // Hapus record
        $layanan->delete();

        return redirect()->route('admin-layanan')->with('success', 'Layanan berhasil dihapus.');
    }
}