<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    // Menampilkan form aspirasi siswa
    public function index()
    {
        return view('aspirasi.form');
    }

    // Menyimpan aspirasi siswa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'kategori_pengaduan' => 'required|string',
            'detail_pengaduan' => 'required|string',
            'foto_sarana' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto_sarana')) {
            $path = $request->file('foto_sarana')->store('foto-sarana', 'public');
            $validated['foto_sarana'] = $path;
        }

        Aspirasi::create($validated);

        return redirect()->route('aspirasi.form')->with('success', 'Aspirasi berhasil dikirim!');
    }

    // Menampilkan daftar aspirasi
    public function show()
    {
        $aspirasis = Aspirasi::latest()->get();
        return view('aspirasi.daftar', compact('aspirasis'));
    }

    // Menghapus aspirasi
    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        
        if ($aspirasi->foto_sarana) {
            Storage::disk('public')->delete($aspirasi->foto_sarana);
        }
        
        $aspirasi->delete();
        
        return redirect()->route('aspirasi.daftar')->with('success', 'Aspirasi berhasil dihapus!');
    }
}