<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProdukAdminController extends Controller
{
    public function index()
    {
        $produk = Product::orderBy('nama')->paginate(15);
        return view('admin.produk.index', compact('produk'));
    }

    public function buat()
    {
        return view('admin.produk.buat');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'kategori' => 'required',
            'harga'    => 'nullable|numeric',
        ]);

        Product::create([
            'nama'          => $request->nama,
            'merek'         => $request->merek,
            'kategori'      => $request->kategori,
            'deskripsi'     => $request->deskripsi,
            'harga'         => $request->harga,
            'jenis_jerawat' => $request->jenis_jerawat ? json_encode($request->jenis_jerawat) : null,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()->route('admin.produk')->with('sukses', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);

        $request->validate([
            'nama'     => 'required|string|max:255',
            'kategori' => 'required',
            'harga'    => 'nullable|numeric',
        ]);

        $produk->update([
            'nama'          => $request->nama,
            'merek'         => $request->merek,
            'kategori'      => $request->kategori,
            'deskripsi'     => $request->deskripsi,
            'harga'         => $request->harga,
            'jenis_jerawat' => $request->jenis_jerawat ? json_encode($request->jenis_jerawat) : null,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()->route('admin.produk')->with('sukses', 'Produk berhasil diperbarui!');
    }

    public function hapus($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.produk')->with('sukses', 'Produk berhasil dihapus.');
    }
}