<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArtikelAdminController extends Controller
{
    public function index()
    {
        $artikel = Article::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.artikel.index', compact('artikel'));
    }

    public function buat()
    {
        return view('admin.artikel.buat');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|in:edukasi,tips,mitos_fakta,produk,lainnya',
        ]);

        Article::create([
            'user_id'      => Auth::id(),
            'judul'        => $request->judul,
            'slug'         => Str::slug($request->judul).'-'.time(),
            'konten'       => $request->konten,
            'kategori'     => $request->kategori,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.artikel')->with('sukses', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $artikel = Article::findOrFail($id);
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Article::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'konten'   => 'required|string',
            'kategori' => 'required|in:edukasi,tips,mitos_fakta,produk,lainnya',
        ]);

        $artikel->update([
            'judul'        => $request->judul,
            'konten'       => $request->konten,
            'kategori'     => $request->kategori,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.artikel')->with('sukses', 'Artikel berhasil diperbarui!');
    }

    public function hapus($id)
    {
        Article::findOrFail($id)->delete();
        return redirect()->route('admin.artikel')->with('sukses', 'Artikel berhasil dihapus.');
    }
}