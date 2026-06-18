<?php

namespace App\Http\Controllers;

use App\Models\SkinJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    // Daftar semua jurnal milik user
    public function index()
    {
        $jurnal = SkinJournal::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('pages.jurnal.index', compact('jurnal'));
    }

    // Form tambah jurnal baru
    public function buat()
    {
        return view('pages.jurnal.buat');
    }

    // Simpan jurnal baru ke database
    public function simpan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'rating'  => 'required|integer|min:1|max:5',
            'kondisi' => 'required|string',
            'catatan' => 'nullable|string|max:1000',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'rating.required'  => 'Rating kondisi wajib dipilih.',
            'kondisi.required' => 'Kondisi kulit wajib dipilih.',
            'foto.image'       => 'File harus berupa gambar.',
            'foto.max'         => 'Ukuran foto maksimal 2MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('jurnal', 'public');
        }

        SkinJournal::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'rating'  => $request->rating,
            'kondisi' => $request->kondisi,
            'catatan' => $request->catatan,
            'foto'    => $fotoPath,
        ]);

        return redirect()->route('jurnal.index')
            ->with('sukses', 'Jurnal kulit berhasil disimpan!');
    }

    // Detail satu jurnal
    public function detail($id)
    {
        $jurnal = SkinJournal::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pages.jurnal.detail', compact('jurnal'));
    }

    // Form edit jurnal
    public function edit($id)
    {
        $jurnal = SkinJournal::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pages.jurnal.edit', compact('jurnal'));
    }

    // Update jurnal
    public function update(Request $request, $id)
    {
        $jurnal = SkinJournal::where('user_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'rating'  => 'required|integer|min:1|max:5',
            'kondisi' => 'required|string',
            'catatan' => 'nullable|string|max:1000',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = $jurnal->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($jurnal->foto) {
                Storage::disk('public')->delete($jurnal->foto);
            }
            $fotoPath = $request->file('foto')->store('jurnal', 'public');
        }

        $jurnal->update([
            'tanggal' => $request->tanggal,
            'rating'  => $request->rating,
            'kondisi' => $request->kondisi,
            'catatan' => $request->catatan,
            'foto'    => $fotoPath,
        ]);

        return redirect()->route('jurnal.index')
            ->with('sukses', 'Jurnal berhasil diperbarui!');
    }

    // Hapus jurnal
    public function hapus($id)
    {
        $jurnal = SkinJournal::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($jurnal->foto) {
            Storage::disk('public')->delete($jurnal->foto);
        }

        $jurnal->delete();

        return redirect()->route('jurnal.index')
            ->with('sukses', 'Jurnal berhasil dihapus.');
    }
}