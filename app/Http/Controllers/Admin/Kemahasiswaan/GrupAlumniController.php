<?php

namespace App\Http\Controllers\Admin\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Models\GrupAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupAlumniController extends Controller
{
    public function index()
    {
        $grup_alumni_list = GrupAlumni::orderBy('id', 'asc')->get();
        return view('admin.kemahasiswaan.kemahasiswaan-grup', compact('grup_alumni_list'));
    }

    /**
     * Menyimpan data grup alumni baru dari modal.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_grup' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'link' => 'required|url|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-grup')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true); // Flag untuk membuka kembali modal
        }

        GrupAlumni::create($request->all());

        return redirect()->route('admin-grup')->with('success', 'Grup alumni berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman form untuk mengedit data.
     */
    public function edit(GrupAlumni $grupAlumni)
    {
        return view('admin.kemahasiswaan.kemahasiswaan-grup-edit', ['grup' => $grupAlumni]);
    }

    /**
     * Memperbarui data dari halaman edit.
     */
    public function update(Request $request, GrupAlumni $grupAlumni)
    {
        $validator = Validator::make($request->all(), [
            'nama_grup' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'link' => 'required|url|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-grup.edit', $grupAlumni->id)
                ->withErrors($validator)
                ->withInput();
        }

        $grupAlumni->update($request->all());

        return redirect()->route('admin-grup')->with('success', 'Grup alumni berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy(GrupAlumni $grupAlumni)
    {
        $grupAlumni->delete();
        return redirect()->route('admin-grup')->with('success', 'Grup alumni berhasil dihapus.');
    }
}