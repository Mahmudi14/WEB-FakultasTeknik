<?php

namespace App\Http\Controllers\Admin\SumberDaya;

use App\Http\Controllers\Controller;
use App\Models\SaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SaranaPrasaranaController extends Controller
{
    public function index()
    {
        $sarana_list = SaranaPrasarana::orderBy('id', 'asc')->get();
        return view('admin.sumberdaya.sd-sarana', compact('sarana_list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-sarana')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true); // Flag untuk membuka kembali modal
        }

        $gambarPath = $request->file('gambar')->store('uploads/sarana_prasarana', 'public');

        SaranaPrasarana::create([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-sarana')->with('success', 'Data sarana & prasarana berhasil ditambahkan.');
    }

    public function edit(SaranaPrasarana $saranaPrasarana)
    {
        return view('admin.sumberdaya.sd-sarana-edit', ['sarana' => $saranaPrasarana]);
    }

    public function update(Request $request, SaranaPrasarana $saranaPrasarana)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opsional saat update
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-sarana.edit', $saranaPrasarana->id)
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $saranaPrasarana->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($saranaPrasarana->gambar && Storage::disk('public')->exists($saranaPrasarana->gambar)) {
                Storage::disk('public')->delete($saranaPrasarana->gambar);
            }
            // Unggah gambar baru
            $gambarPath = $request->file('gambar')->store('uploads/sarana_prasarana', 'public');
        }

        $saranaPrasarana->update([
            'nama' => $request->nama,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-sarana')->with('success', 'Data sarana & prasarana berhasil diperbarui.');
    }

    public function destroy(SaranaPrasarana $saranaPrasarana)
    {
        // Hapus gambar dari storage
        if ($saranaPrasarana->gambar && Storage::disk('public')->exists($saranaPrasarana->gambar)) {
            Storage::disk('public')->delete($saranaPrasarana->gambar);
        }

        $saranaPrasarana->delete();

        return redirect()->route('admin-sarana')->with('success', 'Data sarana & prasarana berhasil dihapus.');
    }
}