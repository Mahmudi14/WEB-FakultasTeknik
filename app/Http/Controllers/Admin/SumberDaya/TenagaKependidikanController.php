<?php

namespace App\Http\Controllers\Admin\SumberDaya;

use App\Http\Controllers\Controller;
use App\Models\TenagaKependidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TenagaKependidikanController extends Controller
{
    public function index()
    {
        $tendik_list = TenagaKependidikan::orderBy('id', 'asc')->get();
        return view('admin.sumberdaya.sd-tendik', compact('tendik_list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-tenaga-kependidikan')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true); // Flag untuk membuka kembali modal
        }

        $gambarPath = $request->file('gambar')->store('uploads/tenaga_kependidikan', 'public');

        TenagaKependidikan::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-tenaga-kependidikan')->with('success', 'Data tenaga kependidikan berhasil ditambahkan.');
    }

    public function edit(TenagaKependidikan $tenagaKependidikan)
    {
        return view('admin.sumberdaya.sd-tendik-edit', ['tendik' => $tenagaKependidikan]);
    }

    public function update(Request $request, TenagaKependidikan $tenagaKependidikan)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opsional saat update
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-tenaga-kependidikan.edit', $tenagaKependidikan->id)
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $tenagaKependidikan->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tenagaKependidikan->gambar && Storage::disk('public')->exists($tenagaKependidikan->gambar)) {
                Storage::disk('public')->delete($tenagaKependidikan->gambar);
            }
            // Unggah gambar baru
            $gambarPath = $request->file('gambar')->store('uploads/tenaga_kependidikan', 'public');
        }

        $tenagaKependidikan->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-tenaga-kependidikan')->with('success', 'Data tenaga kependidikan berhasil diperbarui.');
    }

    public function destroy(TenagaKependidikan $tenagaKependidikan)
    {
        // Hapus gambar dari storage
        if ($tenagaKependidikan->gambar && Storage::disk('public')->exists($tenagaKependidikan->gambar)) {
            Storage::disk('public')->delete($tenagaKependidikan->gambar);
        }

        $tenagaKependidikan->delete();

        return redirect()->route('admin-tenaga-kependidikan')->with('success', 'Data tenaga kependidikan berhasil dihapus.');
    }
}