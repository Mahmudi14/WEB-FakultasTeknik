<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StrukturController extends Controller
{
    public function index()
    {
        // Mengambil data struktur pertama yang ada. Jika belum ada, hasilnya akan null.
        $struktur = Struktur::first();
        return view('admin.profil.profil-struktur', compact('struktur'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,svg|max:5120', // Maksimal 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-struktur') // Kembali ke halaman struktur
                ->withErrors($validator)
                ->withInput();
        }

        // Cari data struktur yang sudah ada
        $struktur = Struktur::first();

        // Handle File Upload
        if ($request->hasFile('gambar')) {
            // Jika ada gambar lama, hapus dari storage
            if ($struktur && $struktur->gambar && Storage::disk('public')->exists($struktur->gambar)) {
                Storage::disk('public')->delete($struktur->gambar);
            }

            // Simpan gambar baru di storage/app/public/uploads/struktur
            $gambarPath = $request->file('gambar')->store('uploads/struktur', 'public');

            // Gunakan metode updateOrCreate untuk membuat record jika belum ada, atau update jika sudah ada.
            // Kita asumsikan record struktur selalu memiliki id = 1 untuk kemudahan.
            Struktur::updateOrCreate(
                ['id' => 1],
                ['gambar' => $gambarPath]
            );
        }

        return redirect()->route('admin-struktur')->with('success', 'Gambar struktur organisasi berhasil diperbarui.');
    }
}