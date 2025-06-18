<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use App\Models\Misi;
use App\Models\Visi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi = Visi::first();
        $misi = Misi::orderBy('id', 'asc')->get();;
        return view('admin.profil.profil-visimisi', compact('visi', 'misi'));
    }

    public function storeOrUpdateVisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'konten' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-visi-misi')->withErrors($validator)->withInput();
        }

        $visi = Visi::first();

        if ($visi) {
            $visi->konten = $request->input('konten');
            $visi->save();
        } else {
            Visi::create([
                'konten' => $request->input('konten')
            ]);
        }

        return redirect()->route('admin-visi-misi')->with('success', 'Data Visi berhasil disimpan');
    }

    public function storeMisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi_misi' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-visi-misi')
                ->withErrors($validator, 'misiStore')
                ->withInput()
                ->with('show_modal_misi_store', true);
        }

        Misi::create([
            'deskripsi_misi' => $request->input('deskripsi_misi'),
        ]);

        return redirect()->route('admin-visi-misi')->with('success_misi', 'Misi baru berhasil ditambahkan.');
    }

    public function editMisi(Misi $misi) // Route Model Binding
    {
        return view('admin.profil.profil-edit-visimisi', compact('misi')); // View baru untuk form edit misi
    }

    public function updateMisi(Request $request, Misi $misi) // Route Model Binding
    {
        $validator = Validator::make($request->all(), [
            'deskripsi_misi' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-visi-misi', $misi)
                ->withErrors($validator)
                ->withInput();
        }

        $misi->deskripsi_misi = $request->input('deskripsi_misi');
        $misi->save();

        return redirect()->route('admin-visi-misi')->with('success_misi', 'Misi berhasil diperbarui.');
    }

    public function destroyMisi($id) // Route Model Binding
    {
        try {
            $misi = Misi::findOrFail($id); // Cari Misi berdasarkan ID, atau gagal jika tidak ditemukan
            $misi->delete();
            // Menggunakan nama route yang konsisten seperti di metode lain
            return redirect()->route('admin-visi-misi')->with('success_misi', 'Misi berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Menangani jika Misi dengan ID tersebut tidak ditemukan
            return redirect()->route('admin-visi-misi')->with('error_misi', 'Data misi tidak ditemukan.');
        } catch (\Exception $e) {
            // Menangani error umum lainnya saat penghapusan
            return redirect()->route('admin-visi-misi')->with('error_misi', 'Gagal menghapus misi: ' . $e->getMessage());
        }
    }
}