<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index(Request $request)
{
    $query = Article::where('is_published', true);

    if ($request->kategori) {
        $query->where('kategori', $request->kategori);
    }

    $artikel = $query->orderBy('created_at', 'desc')->paginate(9);

    return view('pages.artikel.index', compact('artikel'));
}

    public function detail($slug)
    {
        $artikel = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $related = Article::where('is_published', true)
            ->where('kategori', $artikel->kategori)
            ->where('id', '!=', $artikel->id)
            ->take(3)
            ->get();

        return view('pages.artikel.detail', compact('artikel', 'related'));
    }
}