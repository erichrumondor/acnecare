@extends('layouts.app')
@section('title', 'Jurnal Kulit')

@push('styles')
<style>
    body { background: #F8FDFB; }
    .ac-sidebar {
        width: 240px; min-height: calc(100vh - 64px);
        background: #fff; border-right: 1px solid var(--ac-border);
        padding: 1.5rem 0; position: fixed; top: 64px; left: 0; z-index: 100;
    }
    .sidebar-section { padding: 0 1rem; margin-bottom: 1.5rem; }
    .sidebar-label { font-size:.7rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--ac-muted); padding:0 .75rem; margin-bottom:.4rem; }
    .sidebar-link { display:flex; align-items:center; gap:10px; padding:.6rem .75rem; border-radius:10px; font-size:.875rem; font-weight:500; color:var(--ac-muted); text-decoration:none; transition:all .15s; margin-bottom:2px; }
    .sidebar-link:hover { background:var(--ac-green-light); color:var(--ac-green-dark); }
    .sidebar-link.active { background:var(--ac-green-light); color:var(--ac-green-dark); font-weight:600; }
    .sidebar-link i { font-size:1.05rem; width:20px; text-align:center; }
    .sidebar-user { padding:1rem; margin:0 1rem 1.5rem; background:var(--ac-green-light); border-radius:12px; }
    .sidebar-avatar { width:36px; height:36px; background:var(--ac-green); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:.9rem; flex-shrink:0; }
    .ac-main { margin-left:240px; padding:2rem; min-height:calc(100vh - 64px); }
    .journal-card { background:#fff; border:1px solid var(--ac-border); border-radius:16px; padding:1.25rem; transition:all .2s; }
    .journal-card:hover { border-color:var(--ac-green-mid); box-shadow:0 4px 20px rgba(29,158,117,.1); transform:translateY(-2px); }
    .journal-photo { width:100%; height:140px; object-fit:cover; border-radius:10px; margin-bottom:.875rem; }
    .journal-photo-placeholder { width:100%; height:140px; background:var(--ac-green-light); border-radius:10px; margin-bottom:.875rem; display:flex; align-items:center; justify-content:center; color:var(--ac-green); font-size:2rem; }
    .rating-stars { display:flex; gap:3px; }
    .rating-stars i { font-size:.9rem; }
    .kondisi-badge { font-size:.75rem; padding:3px 10px; border-radius:999px; font-weight:600; }
    .empty-state { text-align:center; padding:4rem 2rem; background:#fff; border:1px dashed var(--ac-border); border-radius:16px; }
    @media(max-width:991px){.ac-sidebar{display:none}.ac-main{margin-left:0;padding:1.25rem}}
</style>
@endpush

@section('content')
<div class="d-flex">
    <aside class="ac-sidebar d-none d-lg-block">
        <div class="sidebar-user">
            <div class="d-flex align-items-center gap-2">
                <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div style="font-size:.875rem;font-weight:600;color:var(--ac-green-dark)">{{ auth()->user()->name }}</div>
                    <div style="font-size:.75rem;color:var(--ac-muted)">{{ Str::limit(auth()->user()->email,22) }}</div>
                </div>
            </div>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Menu Utama</div>
            <a href="{{ url('/dashboard') }}" class="sidebar-link"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ url('/jurnal') }}" class="sidebar-link active"><i class="bi bi-journal-heart"></i> Jurnal Kulit</a>
            <a href="{{ url('/konsultasi') }}" class="sidebar-link"><i class="bi bi-clipboard2-pulse"></i> Konsultasi</a>
            <a href="{{ url('/produk') }}" class="sidebar-link"><i class="bi bi-bag-heart"></i> Produk</a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Komunitas</div>
            <a href="{{ url('/artikel') }}" class="sidebar-link"><i class="bi bi-newspaper"></i> Artikel</a>
            <a href="{{ url('/forum') }}" class="sidebar-link"><i class="bi bi-chat-dots"></i> Forum</a>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Akun</div>
            <a href="{{ url('/profil') }}" class="sidebar-link"><i class="bi bi-person-circle"></i> Profil Saya</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start" style="cursor:pointer">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="ac-main flex-grow-1">
        {{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <div>
                <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                    <i class="bi bi-journal-heart me-2"></i>Jurnal Kulit
                </h1>
                <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">
                    Total {{ $jurnal->total() }} catatan kondisi kulitmu
                </p>
            </div>
            <a href="{{ route('jurnal.buat') }}" class="btn btn-ac-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Jurnal
            </a>
        </div>

        {{-- Alert sukses --}}
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible d-flex align-items-center gap-2 mb-4" style="border-radius:12px;border:none;background:#E1F5EE;color:#085041">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('sukses') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Daftar Jurnal --}}
        @if($jurnal->count() > 0)
        <div class="row g-3">
            @foreach($jurnal as $item)
            <div class="col-md-6 col-lg-4">
                <div class="journal-card">
                    {{-- Foto --}}
                    @if($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" alt="Foto jurnal" class="journal-photo">
                    @else
                        <div class="journal-photo-placeholder">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif

                    {{-- Info --}}
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div style="font-size:.8rem;color:var(--ac-muted)">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $item->tanggal->translatedFormat('d F Y') }}
                        </div>
                        <span class="kondisi-badge
                            @if($item->kondisi == 'membaik') bg-success bg-opacity-10 text-success
                            @elseif($item->kondisi == 'memburuk') bg-danger bg-opacity-10 text-danger
                            @else bg-warning bg-opacity-10 text-warning @endif">
                            {{ ucfirst($item->kondisi) }}
                        </span>
                    </div>

                    {{-- Rating bintang --}}
                    <div class="rating-stars mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill" style="color:{{ $i <= $item->rating ? '#F59E0B' : '#E5E7EB' }}"></i>
                        @endfor
                        <span style="font-size:.75rem;color:var(--ac-muted);margin-left:5px">{{ $item->rating_label }}</span>
                    </div>

                    {{-- Catatan --}}
                    @if($item->catatan)
                    <p style="font-size:.825rem;color:var(--ac-muted);margin-bottom:1rem;line-height:1.6">
                        {{ Str::limit($item->catatan, 80) }}
                    </p>
                    @endif

                    {{-- Tombol aksi --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('jurnal.detail', $item->id) }}" class="btn btn-ac-outline btn-sm flex-grow-1" style="font-size:.8rem">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                        <a href="{{ route('jurnal.edit', $item->id) }}" class="btn btn-sm" style="background:#F1EFE8;color:#5F5E5A;border-radius:8px;font-size:.8rem">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('jurnal.hapus', $item->id) }}" onsubmit="return confirm('Yakin hapus jurnal ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FAECE7;color:#D85A30;border-radius:8px;font-size:.8rem">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4">{{ $jurnal->links() }}</div>

        @else
        {{-- Empty State --}}
        <div class="empty-state">
            <div style="font-size:3rem;margin-bottom:1rem">📓</div>
            <h3 style="font-size:1.1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.5rem">Belum ada jurnal</h3>
            <p style="font-size:.875rem;color:var(--ac-muted);max-width:320px;margin:0 auto 1.5rem;line-height:1.7">
                Mulai catat kondisi kulitmu setiap hari untuk memantau perkembangan jerawatmu.
            </p>
            <a href="{{ route('jurnal.buat') }}" class="btn btn-ac-primary">
                <i class="bi bi-plus-lg me-1"></i> Buat Jurnal Pertama
            </a>
        </div>
        @endif
    </main>
</div>
@endsection