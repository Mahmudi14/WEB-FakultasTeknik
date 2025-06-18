<?php

namespace App\Http\Controllers\Admin\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Models\PeraturanKemahasiswaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeraturanKemahasiswaanController extends Controller
{
    public function index()
    {
        $peraturan_list = PeraturanKemahasiswaan::orderBy('id', 'asc')->get();
        return view('admin.kemahasiswaan.kemahasiswaan-peraturan', compact('peraturan_list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_peraturan' => 'required|string|max:255',
            'link' => 'required|url|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-peraturan')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true); // Flag untuk membuka kembali modal
        }

        PeraturanKemahasiswaan::create($request->all());

        return redirect()->route('admin-peraturan')->with('success', 'Peraturan berhasil ditambahkan.');
    }

    public function edit(PeraturanKemahasiswaan $peraturanKemahasiswaan)
    {
        return view('admin.kemahasiswaan.kemahasiswaan-peraturan-edit', ['peraturan' => $peraturanKemahasiswaan]);
    }

    public function update(Request $request, PeraturanKemahasiswaan $peraturanKemahasiswaan)
    {
        $validator = Validator::make($request->all(), [
            'nama_peraturan' => 'required|string|max:255',
            'link' => 'required|url|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-peraturan.edit', $peraturanKemahasiswaan->id)
                ->withErrors($validator)
                ->withInput();
        }

        $peraturanKemahasiswaan->update($request->all());

        return redirect()->route('admin-peraturan')->with('success', 'Peraturan berhasil diperbarui.');
    }

    public function destroy(PeraturanKemahasiswaan $peraturanKemahasiswaan)
    {
        $peraturanKemahasiswaan->delete();
        return redirect()->route('admin-peraturan')->with('success', 'Peraturan berhasil dihapus.');
    }
}