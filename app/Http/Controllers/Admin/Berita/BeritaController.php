<?php

namespace App\Http\Controllers\Admin\Berita;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk mengelola file
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        // Eager load relasi 'kategoris' untuk menghindari N+1 problem
        $beritas = Berita::with('kategoris')->latest()->paginate(10);
        return view('admin.berita.berita', compact('beritas'));
    }

    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori untuk form
        return view('admin.berita.berita-create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft',
            'kategoris' => 'required|array', // Pastikan kategoris dikirim sebagai array
            'kategoris.*' => 'exists:kategoris,id' // Pastikan setiap id kategori ada di tabel
        ]);

        $path_gambar = $request->file('gambar')->store('public/berita', 'public');

        $berita = Berita::create([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . time(), // Tambah time() agar slug unik
            'konten' => $validated['konten'],
            'status' => $validated['status'],
            'gambar' => $path_gambar,
        ]);

        // Lampirkan kategori ke berita yang baru dibuat
        $berita->kategoris()->attach($validated['kategoris']);

        return redirect()->route('admin-berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        $kategoris = Kategori::all();
        return view('admin.berita.berita-edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft',
            'kategoris' => 'required|array',
            'kategoris.*' => 'exists:kategoris,id'
        ]);

        $path_gambar = $berita->gambar;

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $path_gambar = $request->file('gambar')->store('uploads/berita', 'public');
        }

        $berita->update([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . time(),
            'konten' => $validated['konten'],
            'status' => $validated['status'],
            'gambar' => $path_gambar,
        ]);

        // Sinkronkan kategori. Sync akan otomatis menambah/menghapus relasi yg berubah
        $berita->kategoris()->sync($validated['kategoris']);

        return redirect()->route('admin-berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        // Hapus gambar dari storage
        if ($berita->gambar) {
            Storage::delete($berita->gambar);
        }

        $berita->delete(); // Relasi di pivot table akan otomatis terhapus karena onDelete('cascade')

        return redirect()->route('admin-berita')->with('success', 'Berita berhasil dihapus.');
    }
}