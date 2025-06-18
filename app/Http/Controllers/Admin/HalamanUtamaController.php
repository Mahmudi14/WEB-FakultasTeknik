<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HalamanUtama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HalamanUtamaController extends Controller
{
    public function index()
    {
        $halamanUtama = HalamanUtama::first();
        return view('admin.home', compact('halamanUtama'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hero_title' => 'required|string|max:255',
            'sambutan_dekan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-home')->withErrors($validator)->withInput();
        }

        $halamanUtama = HalamanUtama::first();

        if ($halamanUtama) {
            $halamanUtama->hero_title = $request->input('hero_title');
            $halamanUtama->sambutan_dekan = $request->input('sambutan_dekan');
            $halamanUtama->save();
        } else {
            HalamanUtama::create([
                'hero_title' => $request->input('hero_title'),
                'sambutan_dekan' => $request->input('sambutan_dekan'),
            ]);
        }

        return redirect()->route('admin-home')->with('success', 'Data Halaman Utama berhasil disimpan');
    }
}