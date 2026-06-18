<?php
namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumPost::with('user')
            ->withCount('comments')
            ->orderBy('created_at', 'desc');

        if ($request->topik) {
            $query->where('topik', $request->topik);
        }

        $posts = $query->paginate(10);

        return view('pages.forum.index', compact('posts'));
    }

    public function detail($id)
    {
        $post = ForumPost::with(['user', 'comments.user', 'comments.replies.user'])
            ->findOrFail($id);

        $post->increment('views');

        $comments = ForumComment::where('forum_post_id', $id)
            ->whereNull('parent_id')
            ->with(['user', 'replies.user'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.forum.detail', compact('post', 'comments'));
    }

    public function buat()
    {
        return view('pages.forum.buat');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string',
            'topik'  => 'required|in:papula,pustula,komedo,nodul,produk,tips,umum',
        ]);

        $post = ForumPost::create([
            'user_id' => Auth::id(),
            'judul'   => $request->judul,
            'konten'  => $request->konten,
            'topik'   => $request->topik,
        ]);

        return redirect()->route('forum.detail', $post->id)
            ->with('sukses', 'Postingan berhasil dibuat!');
    }

    public function komentar(Request $request, $id)
    {
        $request->validate([
            'konten'    => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:forum_comments,id',
        ]);

        ForumComment::create([
            'user_id'       => Auth::id(),
            'forum_post_id' => $id,
            'konten'        => $request->konten,
            'parent_id'     => $request->parent_id,
        ]);

        return redirect()->route('forum.detail', $id)
            ->with('sukses', 'Komentar berhasil ditambahkan!');
    }

    public function hapus($id)
    {
        $post = ForumPost::where('user_id', Auth::id())
            ->findOrFail($id);

        $post->delete();

        return redirect()->route('forum.index')
            ->with('sukses', 'Postingan berhasil dihapus.');
    }
}