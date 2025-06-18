<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        // Ambil data kalender yang ada (kita asumsikan hanya ada satu)
        $kalender = KalenderAkademik::first();
        return view('admin.akademik.akademik-kalender', compact('kalender'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg,svg|max:5120', // Maksimal 5MB
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-kalender')
                ->withErrors($validator)
                ->withInput();
        }
        // Cari kalender yang sudah ada
        $kalender = KalenderAkademik::first();

        if ($request->hasFile('gambar')) {
            if ($kalender && $kalender->gambar && Storage::disk('public')->exists($kalender->gambar)) {
                Storage::disk('public')->delete($kalender->gambar);
            }

            $gambarPath = $request->file('gambar')->store('uploads/kalender', 'public');

            KalenderAkademik::updateOrCreate(
                ['id' => 1],
                ['gambar' => $gambarPath]
            );
        }


        return redirect()->route('admin-kalender')->with('success', 'Kalender Akademik berhasil diperbarui.');
    }
}