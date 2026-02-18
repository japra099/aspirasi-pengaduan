<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiFeedbackController extends Controller
{
    // Menampilkan halaman feedback admin
    public function index(Request $request)
    {
        $aspirasis = Aspirasi::latest()->get();
        return view('feedback.index', compact('aspirasis'));
    }

    // Update status dan umpan balik
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai',
            'umpan_balik' => 'nullable|string'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update($validated);

        return redirect()->route('feedback.index')->with('success', 'Umpan balik berhasil diperbarui!');
    }
}