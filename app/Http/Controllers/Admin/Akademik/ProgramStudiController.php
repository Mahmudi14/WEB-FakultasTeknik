<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $program_studi_list = ProgramStudi::orderBy('id', 'asc')->get();
        return view('admin.akademik.akademik-programstudi', compact('program_studi_list'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'program_studi' => 'required|string|max:255',
            'koordinator' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-program-studi')
                ->withErrors($validator)
                ->withInput()
                ->with('show_modal_add', true); // Flag untuk membuka kembali modal
        }

        $gambarPath = $request->file('gambar')->store('uploads/program_studi', 'public');

        ProgramStudi::create([
            'program_studi' => $request->program_studi,
            'koordinator' => $request->koordinator,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-program-studi')->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function edit(ProgramStudi $programStudi)
    {
        return view('admin.akademik.akademik-programstudi-edit', ['program_studi' => $programStudi]);
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        $validator = Validator::make($request->all(), [
            'program_studi' => 'required|string|max:255',
            'koordinator' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-program-studi.edit', $programStudi->id)
                ->withErrors($validator)
                ->withInput();
        }

        $gambarPath = $programStudi->gambar;

        if ($request->hasFile('gambar')) {
            if ($programStudi->gambar && Storage::disk('public')->exists($programStudi->gambar)) {
                Storage::disk('public')->delete($programStudi->gambar);
            }
            $gambarPath = $request->file('gambar')->store('uploads/program_studi', 'public');
        }

        $programStudi->update([
            'program_studi' => $request->program_studi,
            'koordinator' => $request->koordinator,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin-program-studi')->with('success', 'Program studi berhasil diperbarui.');
    }
    public function destroy(ProgramStudi $programStudi)
    {
        if ($programStudi->gambar && Storage::disk('public')->exists($programStudi->gambar)) {
            Storage::disk('public')->delete($programStudi->gambar);
        }

        $programStudi->delete();

        return redirect()->route('admin-program-studi')->with('success', 'Program studi berhasil dihapus.');
    }
}