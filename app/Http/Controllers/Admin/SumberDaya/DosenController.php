<?php

namespace App\Http\Controllers\Admin\SumberDaya;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index()
    {
        $dosen_list = Dosen::orderBy('id', 'asc')->get();
        return view('admin.sumberdaya.sd-dosen', compact('dosen_list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'nidn' => 'required|string|max:255|unique:dosen,nidn',
            'jabatan_fungsional' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-dosen')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true);
        }

        $gambarPath = $request->file('gambar')->store('uploads/dosen', 'public');

        Dosen::create([
            'nama' => $request->nama,
            'program_studi' => $request->program_studi,
            'pendidikan' => $request->pendidikan,
            'nidn' => $request->nidn,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-dosen')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('admin.sumberdaya.sb-dosen-edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'nidn' => 'required|string|max:255|unique:dosen,nidn,' . $dosen->id, // Abaikan NIDN saat ini saat validasi unik
            'jabatan_fungsional' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Opsional saat update
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-dosen.edit', $dosen->id)
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $dosen->gambar;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($dosen->gambar && Storage::disk('public')->exists($dosen->gambar)) {
                Storage::disk('public')->delete($dosen->gambar);
            }
            // Unggah gambar baru
            $gambarPath = $request->file('gambar')->store('uploads/dosen', 'public');
        }

        $dosen->update([
            'nama' => $request->nama,
            'program_studi' => $request->program_studi,
            'pendidikan' => $request->pendidikan,
            'nidn' => $request->nidn,
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-dosen')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        // Hapus gambar dari storage
        if ($dosen->gambar && Storage::disk('public')->exists($dosen->gambar)) {
            Storage::disk('public')->delete($dosen->gambar);
        }

        $dosen->delete();

        return redirect()->route('admin-dosen')->with('success', 'Data dosen berhasil dihapus.');
    }
}