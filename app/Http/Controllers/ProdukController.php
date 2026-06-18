<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Daftar produk & treatment aktif user
    public function index()
    {
        $treatments = Treatment::where('user_id', Auth::id())
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $produk = Product::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('pages.produk.index', compact('treatments', 'produk'));
    }

    // Form tambah treatment
    public function tambah()
    {
        $produk = Product::where('is_active', true)
            ->orderBy('nama')
            ->get();

        return view('pages.produk.tambah', compact('produk'));
    }

    // Simpan treatment baru
    public function simpan(Request $request)
    {
        $request->validate([
            'product_id'  => 'nullable|exists:products,id',
            'nama_produk' => 'required|string|max:255',
            'waktu_pakai' => 'required|in:pagi,malam,pagi_malam',
            'frekuensi'   => 'nullable|string|max:100',
            'mulai_pakai' => 'required|date',
        ]);

        Treatment::create([
            'user_id'     => Auth::id(),
            'product_id'  => $request->product_id,
            'nama_produk' => $request->nama_produk,
            'waktu_pakai' => $request->waktu_pakai,
            'frekuensi'   => $request->frekuensi,
            'mulai_pakai' => $request->mulai_pakai,
            'is_active'   => true,
            'catatan'     => $request->catatan,
        ]);

        return redirect()->route('produk.index')
            ->with('sukses', 'Produk berhasil ditambahkan ke daftar perawatanmu!');
    }

    // Nonaktifkan treatment
    public function nonaktif($id)
    {
        $treatment = Treatment::where('user_id', Auth::id())
            ->findOrFail($id);

        $treatment->update([
            'is_active'    => false,
            'selesai_pakai' => now(),
        ]);

        return redirect()->route('produk.index')
            ->with('sukses', 'Produk berhasil dinonaktifkan.');
    }

    // Hapus treatment
    public function hapus($id)
    {
        $treatment = Treatment::where('user_id', Auth::id())
            ->findOrFail($id);

        $treatment->delete();

        return redirect()->route('produk.index')
            ->with('sukses', 'Produk berhasil dihapus.');
    }
}