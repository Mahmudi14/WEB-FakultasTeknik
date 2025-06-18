<?php

namespace App\Http\Controllers\Admin\Berita;

use App\Http\Controllers\Controller;
use App\Models\Kategori; // Jangan lupa import model
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Import Str untuk membuat slug

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10); // Ambil data terbaru dan paginasi
        return view('admin.berita.berita-kategori', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.berita.berita-kategori-create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris',
        ]);

        // Buat data baru
        Kategori::create([
            'nama' => $validated['nama'],
            'slug' => Str::slug($validated['nama']),
        ]);

        return redirect()->route('admin-kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.berita.berita-kategori-edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategoris,nama,' . $kategori->id,
        ]);

        // Update data
        $kategori->update([
            'nama' => $validated['nama'],
            'slug' => Str::slug($validated['nama']),
        ]);

        return redirect()->route('admin-kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin-kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}