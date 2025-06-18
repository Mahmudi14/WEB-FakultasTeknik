<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use App\Models\Pimpinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PimpinanController extends Controller
{
    public function index()
    {
        $pimpinan_list = Pimpinan::orderBy('id', 'asc')->get();
        return view('admin.profil.profil-pimpinan', compact('pimpinan_list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Wajib ada gambar saat pertama kali dibuat
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-pimpinan')
                ->withErrors($validator)
                ->withInput();
        }

        // Handle File Upload
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            // Simpan gambar di storage/app/public/uploads/pimpinan
            // Nama file akan unik
            $gambarPath = $request->file('gambar')->store('uploads/pimpinan', 'public');
        }

        Pimpinan::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-pimpinan')->with('success', 'Data pimpinan berhasil ditambahkan.');
    }

    public function edit(Pimpinan $pimpinan)
    {
        return view('admin.profil.profil-pimpinan-edit', compact('pimpinan'));
    }

    public function update(Request $request, Pimpinan $pimpinan)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar tidak wajib saat update
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-pimpinan.edit', $pimpinan->id)
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $pimpinan->gambar; // Gunakan gambar lama secara default

        if ($request->hasFile('gambar')) {
            // Jika ada gambar baru diunggah, hapus gambar lama
            if ($pimpinan->gambar && Storage::disk('public')->exists($pimpinan->gambar)) {
                Storage::disk('public')->delete($pimpinan->gambar);
            }

            // Unggah gambar baru
            $gambarPath = $request->file('gambar')->store('uploads/pimpinan', 'public');
        }

        $pimpinan->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-pimpinan')->with('success', 'Data pimpinan berhasil diperbarui.');
    }

    /**
     * Menghapus data pimpinan dari database.
     */
    public function destroy(Pimpinan $pimpinan)
    {
        // Hapus gambar terkait dari storage
        if ($pimpinan->gambar && Storage::disk('public')->exists($pimpinan->gambar)) {
            Storage::disk('public')->delete($pimpinan->gambar);
        }

        $pimpinan->delete();

        return redirect()->route('admin-pimpinan')->with('success', 'Data pimpinan berhasil dihapus.');
    }
}