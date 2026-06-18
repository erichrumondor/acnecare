@extends('layouts.app')
@section('title', 'Artikel & Edukasi')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:900px; margin:2rem auto; padding:0 1rem; }
    .artikel-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1.25rem; }
    .artikel-card { background:#fff; border:1px solid var(--ac-border); border-radius:16px; overflow:hidden; transition:all .2s; text-decoration:none; display:block; }
    .artikel-card:hover { border-color:var(--ac-green-mid); box-shadow:0 8px 24px rgba(29,158,117,.1); transform:translateY(-3px); }
    .artikel-img { width:100%; height:160px; object-fit:cover; background:var(--ac-green-light); display:flex; align-items:center; justify-content:center; font-size:3rem; }
    .artikel-body { padding:1.25rem; }
    .kategori-badge { font-size:.7rem; padding:3px 10px; border-radius:999px; font-weight:600; margin-bottom:.75rem; display:inline-block; }
    .edukasi { background:#E1F5EE; color:#085041; }
    .tips { background:#E6F1FB; color:#185FA5; }
    .mitos_fakta { background:#FAEEDA; color:#633806; }
    .produk { background:#EEEDFE; color:#3C3489; }
    .lainnya { background:#F1EFE8; color:#5F5E5A; }
    .artikel-judul { font-size:.95rem; font-weight:700; color:var(--ac-green-dark); margin-bottom:.5rem; line-height:1.4; }
    .artikel-meta { font-size:.775rem; color:var(--ac-muted); }
    .filter-wrap { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-btn { font-size:.8rem; padding:5px 14px; border-radius:999px; border:1.5px solid var(--ac-border); background:#fff; color:var(--ac-muted); cursor:pointer; text-decoration:none; transition:all .15s; }
    .filter-btn:hover, .filter-btn.active { border-color:var(--ac-green); background:var(--ac-green-light); color:var(--ac-green-dark); }
    .empty-state { text-align:center; padding:4rem 2rem; background:#fff; border:1px dashed var(--ac-border); border-radius:16px; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                <i class="bi bi-newspaper me-2"></i>Artikel & Edukasi
            </h1>
            <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">
                Tips, edukasi, dan informasi seputar kesehatan kulit jerawat
            </p>
        </div>
    </div>

    {{-- Filter kategori --}}
    <div class="filter-wrap">
        <a href="{{ route('artikel.index') }}" class="filter-btn {{ !request('kategori') ? 'active' : '' }}">Semua</a>
        <a href="{{ route('artikel.index', ['kategori' => 'edukasi']) }}" class="filter-btn {{ request('kategori') == 'edukasi' ? 'active' : '' }}">📚 Edukasi</a>
        <a href="{{ route('artikel.index', ['kategori' => 'tips']) }}" class="filter-btn {{ request('kategori') == 'tips' ? 'active' : '' }}">💡 Tips</a>
        <a href="{{ route('artikel.index', ['kategori' => 'mitos_fakta']) }}" class="filter-btn {{ request('kategori') == 'mitos_fakta' ? 'active' : '' }}">🔍 Mitos vs Fakta</a>
        <a href="{{ route('artikel.index', ['kategori' => 'produk']) }}" class="filter-btn {{ request('kategori') == 'produk' ? 'active' : '' }}">🛍️ Produk</a>
    </div>

    {{-- Grid artikel --}}
    @if($artikel->count() > 0)
    <div class="artikel-grid">
        @foreach($artikel as $a)
        <a href="{{ route('artikel.detail', $a->slug) }}" class="artikel-card">
            <div class="artikel-img">
                @switch($a->kategori)
                    @case('edukasi') 📚 @break
                    @case('tips') 💡 @break
                    @case('mitos_fakta') 🔍 @break
                    @case('produk') 🛍️ @break
                    @default 📄
                @endswitch
            </div>
            <div class="artikel-body">
                <span class="kategori-badge {{ $a->kategori }}">
                    {{ ucfirst(str_replace('_', ' ', $a->kategori)) }}
                </span>
                <div class="artikel-judul">{{ $a->judul }}</div>
                <div class="artikel-meta">
                    <i class="bi bi-calendar3 me-1"></i>{{ $a->created_at->format('d M Y') }}
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="mt-4">{{ $artikel->links() }}</div>
    @else
    <div class="empty-state">
        <div style="font-size:3rem;margin-bottom:1rem">📰</div>
        <h3 style="font-size:1.1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.5rem">Belum ada artikel</h3>
        <p style="font-size:.875rem;color:var(--ac-muted)">Artikel akan segera hadir!</p>
    </div>
    @endif
</div>
@endsection