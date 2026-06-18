@extends('layouts.app')
@section('title', 'Forum Diskusi')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:800px; margin:2rem auto; padding:0 1rem; }
    .post-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1.25rem; margin-bottom:.75rem; text-decoration:none; display:block; transition:all .2s; }
    .post-card:hover { border-color:var(--ac-green-mid); box-shadow:0 4px 16px rgba(29,158,117,.08); }
    .topik-badge { font-size:.7rem; padding:3px 10px; border-radius:999px; font-weight:600; margin-bottom:.5rem; display:inline-block; }
    .papula { background:#FAECE7; color:#993C1D; }
    .pustula { background:#FAEEDA; color:#633806; }
    .komedo { background:#F1EFE8; color:#444441; }
    .nodul { background:#EEEDFE; color:#3C3489; }
    .produk { background:#E6F1FB; color:#185FA5; }
    .tips { background:#E1F5EE; color:#085041; }
    .umum { background:#F1EFE8; color:#5F5E5A; }
    .filter-wrap { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-btn { font-size:.8rem; padding:5px 14px; border-radius:999px; border:1.5px solid var(--ac-border); background:#fff; color:var(--ac-muted); cursor:pointer; text-decoration:none; transition:all .15s; }
    .filter-btn:hover, .filter-btn.active { border-color:var(--ac-green); background:var(--ac-green-light); color:var(--ac-green-dark); }
    .post-avatar { width:36px; height:36px; border-radius:50%; background:var(--ac-green); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:.875rem; flex-shrink:0; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                <i class="bi bi-chat-dots me-2"></i>Forum Diskusi
            </h1>
            <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">
                Berbagi pengalaman dan tips seputar perawatan kulit jerawat
            </p>
        </div>
        @auth
        <a href="{{ route('forum.buat') }}" class="btn btn-ac-primary">
            <i class="bi bi-plus-lg me-1"></i>Buat Postingan
        </a>
        @else
        <a href="{{ route('login') }}" class="btn btn-ac-primary">
            <i class="bi bi-plus-lg me-1"></i>Masuk untuk Posting
        </a>
        @endauth
    </div>

    {{-- Filter --}}
    <div class="filter-wrap">
        <a href="{{ route('forum.index') }}" class="filter-btn {{ !request('topik') ? 'active' : '' }}">Semua</a>
        <a href="{{ route('forum.index', ['topik' => 'komedo']) }}" class="filter-btn {{ request('topik') == 'komedo' ? 'active' : '' }}">⚫ Komedo</a>
        <a href="{{ route('forum.index', ['topik' => 'papula']) }}" class="filter-btn {{ request('topik') == 'papula' ? 'active' : '' }}">🔴 Papula</a>
        <a href="{{ route('forum.index', ['topik' => 'pustula']) }}" class="filter-btn {{ request('topik') == 'pustula' ? 'active' : '' }}">🟡 Pustula</a>
        <a href="{{ route('forum.index', ['topik' => 'nodul']) }}" class="filter-btn {{ request('topik') == 'nodul' ? 'active' : '' }}">🟤 Nodul</a>
        <a href="{{ route('forum.index', ['topik' => 'produk']) }}" class="filter-btn {{ request('topik') == 'produk' ? 'active' : '' }}">🛍️ Produk</a>
        <a href="{{ route('forum.index', ['topik' => 'tips']) }}" class="filter-btn {{ request('topik') == 'tips' ? 'active' : '' }}">💡 Tips</a>
        <a href="{{ route('forum.index', ['topik' => 'umum']) }}" class="filter-btn {{ request('topik') == 'umum' ? 'active' : '' }}">💬 Umum</a>
    </div>

    @if($posts->count() > 0)
        @foreach($posts as $post)
        <a href="{{ route('forum.detail', $post->id) }}" class="post-card">
            <div class="d-flex align-items-start gap-3">
                <div class="post-avatar">{{ strtoupper(substr($post->user->name, 0, 1)) }}</div>
                <div class="flex-grow-1">
                    <span class="topik-badge {{ $post->topik }}">{{ ucfirst($post->topik) }}</span>
                    <div style="font-size:.95rem;font-weight:600;color:var(--ac-green-dark);margin-bottom:.35rem">
                        {{ $post->judul }}
                    </div>
                    <div style="font-size:.825rem;color:var(--ac-muted);margin-bottom:.5rem;line-height:1.5">
                        {{ Str::limit($post->konten, 100) }}
                    </div>
                    <div style="font-size:.775rem;color:var(--ac-muted);display:flex;gap:1rem">
                        <span><i class="bi bi-person me-1"></i>{{ $post->user->name }}</span>
                        <span><i class="bi bi-chat me-1"></i>{{ $post->comments_count }} komentar</span>
                        <span><i class="bi bi-eye me-1"></i>{{ $post->views }}</span>
                        <span><i class="bi bi-clock me-1"></i>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        <div class="mt-3">{{ $posts->links() }}</div>
    @else
        <div style="text-align:center;padding:4rem 2rem;background:#fff;border:1px dashed var(--ac-border);border-radius:16px">
            <div style="font-size:3rem;margin-bottom:1rem">💬</div>
            <h3 style="font-size:1.1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.5rem">Belum ada postingan</h3>
            <p style="font-size:.875rem;color:var(--ac-muted);margin-bottom:1.5rem">Jadilah yang pertama berbagi pengalaman!</p>
            @auth
            <a href="{{ route('forum.buat') }}" class="btn btn-ac-primary">Buat Postingan Pertama</a>
            @endauth
        </div>
    @endif
</div>
@endsection