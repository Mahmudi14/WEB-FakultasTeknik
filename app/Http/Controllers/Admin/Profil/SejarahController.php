<?php

namespace App\Http\Controllers\Admin\Profil;

use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SejarahController extends Controller
{

    public function index()
    {
        $sejarah = Sejarah::first();
        return view('admin.profil.profil-sejarah', compact('sejarah'));
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'konten' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-sejarah')->withErrors($validator)->withInput();
        }

        $sejarah = Sejarah::first();

        if ($sejarah) {
            $sejarah->konten = $request->input('konten');
            $sejarah->save();
        } else {
            Sejarah::create([
                'konten' => $request->input('konten')
            ]);
        }

        return redirect()->route('admin-sejarah')->with('success', 'Data Sejarah berhasil disimpan');
    }
}