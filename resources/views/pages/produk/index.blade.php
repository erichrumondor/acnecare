@extends('layouts.app')
@section('title', 'Produk & Perawatan')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:780px; margin:2rem auto; padding:0 1rem; }
    .section-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:1.75rem; margin-bottom:1.25rem; }
    .treatment-item { display:flex; align-items:center; gap:12px; padding:.875rem 0; border-bottom:.5px solid var(--ac-border); }
    .treatment-item:last-child { border-bottom:none; padding-bottom:0; }
    .treatment-icon { width:42px; height:42px; background:var(--ac-green-light); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }
    .waktu-badge { font-size:.72rem; padding:2px 10px; border-radius:999px; font-weight:600; }
    .pagi { background:#FAEEDA; color:#633806; }
    .malam { background:#EEEDFE; color:#3C3489; }
    .pagi_malam { background:#E1F5EE; color:#085041; }
    .produk-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:12px; }
    .produk-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1rem; transition:all .2s; }
    .produk-card:hover { border-color:var(--ac-green-mid); box-shadow:0 4px 16px rgba(29,158,117,.08); }
    .produk-emoji { font-size:1.75rem; margin-bottom:.5rem; }
    .kategori-badge { font-size:.7rem; padding:2px 8px; border-radius:999px; background:var(--ac-green-light); color:var(--ac-green-dark); font-weight:600; margin-bottom:.5rem; display:inline-block; }
    .empty-state { text-align:center; padding:2.5rem 1rem; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                <i class="bi bi-bag-heart me-2"></i>Produk & Perawatan
            </h1>
            <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">
                Kelola produk skincare yang sedang kamu gunakan
            </p>
        </div>
        <a href="{{ route('produk.tambah') }}" class="btn btn-ac-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Produk
        </a>
    </div>

    @if(session('sukses'))
    <div class="alert d-flex align-items-center gap-2 mb-4" style="border-radius:12px;border:none;background:#E1F5EE;color:#085041">
        <i class="bi bi-check-circle-fill"></i>{{ session('sukses') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- Produk Aktif --}}
    <div class="section-card">
        <div style="font-size:1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1rem">
            <i class="bi bi-bag-check me-2 text-ac"></i>Produk Aktif Dipakai
        </div>

        @if($treatments->count() > 0)
            @foreach($treatments as $t)
            <div class="treatment-item">
                <div class="treatment-icon">
                    @switch($t->product->kategori ?? 'lainnya')
                        @case('serum') 💧 @break
                        @case('cleanser') 🧴 @break
                        @case('moisturizer') 🌿 @break
                        @case('sunscreen') ☀️ @break
                        @case('spot_treatment') 🎯 @break
                        @case('toner') 🫧 @break
                        @case('mask') 🎭 @break
                        @default 📦
                    @endswitch
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:.9rem;font-weight:600;color:var(--ac-green-dark)">{{ $t->nama_produk }}</div>
                    <div style="font-size:.775rem;color:var(--ac-muted)">
                        {{ $t->frekuensi ?? 'Setiap hari' }} · Mulai {{ $t->mulai_pakai->format('d M Y') }}
                    </div>
                </div>
                <span class="waktu-badge {{ $t->waktu_pakai }}">{{ $t->waktu_label }}</span>
                <div class="dropdown">
                    <button class="btn btn-sm" style="background:none;border:none;color:var(--ac-muted)" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="{{ route('produk.nonaktif', $t->id) }}">
                                @csrf @method('PUT')
                                <button type="submit" class="dropdown-item" style="font-size:.875rem">
                                    <i class="bi bi-pause-circle me-2"></i>Nonaktifkan
                                </button>
                            </form>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('produk.hapus', $t->id) }}" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger" style="font-size:.875rem">
                                    <i class="bi bi-trash me-2"></i>Hapus
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach

            <div class="mt-3">
                <a href="{{ route('produk.tambah') }}" class="btn btn-ac-outline w-100 py-2" style="font-size:.875rem">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Produk Baru
                </a>
            </div>
        @else
            <div class="empty-state">
                <div style="font-size:2.5rem;margin-bottom:.75rem">📦</div>
                <div style="font-size:.9rem;font-weight:600;color:var(--ac-green-dark);margin-bottom:.35rem">Belum ada produk aktif</div>
                <p style="font-size:.825rem;color:var(--ac-muted);max-width:280px;margin:0 auto 1rem">
                    Tambahkan produk skincare yang sedang kamu gunakan untuk memantau perawatanmu.
                </p>
                <a href="{{ route('produk.tambah') }}" class="btn btn-ac-primary">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Produk
                </a>
            </div>
        @endif
    </div>

    {{-- Katalog Produk --}}
    <div class="section-card">
        <div style="font-size:1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1rem">
            <i class="bi bi-grid me-2 text-ac"></i>Katalog Produk Rekomendasi
        </div>
        <div class="produk-grid">
            @foreach($produk as $p)
            <div class="produk-card">
                <div class="produk-emoji">
                    @switch($p->kategori)
                        @case('serum') 💧 @break
                        @case('cleanser') 🧴 @break
                        @case('moisturizer') 🌿 @break
                        @case('sunscreen') ☀️ @break
                        @case('spot_treatment') 🎯 @break
                        @case('toner') 🫧 @break
                        @case('mask') 🎭 @break
                        @default 📦
                    @endswitch
                </div>
                <span class="kategori-badge">{{ ucfirst(str_replace('_',' ',$p->kategori)) }}</span>
                <div style="font-size:.875rem;font-weight:600;color:var(--ac-green-dark);margin-bottom:.2rem">{{ $p->nama }}</div>
                <div style="font-size:.775rem;color:var(--ac-muted);margin-bottom:.5rem">{{ $p->merek }}</div>
                @if($p->harga)
                <div style="font-size:.875rem;font-weight:700;color:var(--ac-green);margin-bottom:.75rem">
                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                </div>
                @endif
                <form method="POST" action="{{ route('produk.simpan') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <input type="hidden" name="nama_produk" value="{{ $p->nama }}">
                    <input type="hidden" name="waktu_pakai" value="pagi_malam">
                    <input type="hidden" name="mulai_pakai" value="{{ date('Y-m-d') }}">
                    <button type="submit" class="btn btn-ac-outline w-100" style="font-size:.8rem;padding:.4rem">
                        <i class="bi bi-plus-lg me-1"></i>Pakai Produk
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection