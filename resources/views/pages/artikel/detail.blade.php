@extends('layouts.app')
@section('title', $artikel->judul)

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:720px; margin:2rem auto; padding:0 1rem; }
    .artikel-header { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; margin-bottom:1.25rem; }
    .artikel-content { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; margin-bottom:1.25rem; line-height:1.9; font-size:.95rem; color:#374151; }
    .artikel-content p { margin-bottom:1rem; }
    .artikel-content strong { color:var(--ac-green-dark); font-weight:700; }
    .kategori-badge { font-size:.75rem; padding:4px 12px; border-radius:999px; font-weight:600; display:inline-block; margin-bottom:1rem; }
    .edukasi { background:#E1F5EE; color:#085041; }
    .tips { background:#E6F1FB; color:#185FA5; }
    .mitos_fakta { background:#FAEEDA; color:#633806; }
    .produk { background:#EEEDFE; color:#3C3489; }
    .related-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1rem 1.25rem; text-decoration:none; display:block; transition:all .2s; margin-bottom:.75rem; }
    .related-card:hover { border-color:var(--ac-green-mid); }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="mb-3">
        <a href="{{ route('artikel.index') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Artikel
        </a>
    </div>

    {{-- Header --}}
    <div class="artikel-header">
        <span class="kategori-badge {{ $artikel->kategori }}">
            {{ ucfirst(str_replace('_', ' ', $artikel->kategori)) }}
        </span>
        <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);line-height:1.4;margin-bottom:1rem">
            {{ $artikel->judul }}
        </h1>
        <div style="font-size:.825rem;color:var(--ac-muted);display:flex;gap:1rem;flex-wrap:wrap">
            <span><i class="bi bi-calendar3 me-1"></i>{{ $artikel->created_at->format('d F Y') }}</span>
            <span><i class="bi bi-person me-1"></i>Tim AcneCare</span>
        </div>
    </div>

    {{-- Konten --}}
    <div class="artikel-content">
        {!! nl2br(e($artikel->konten)) !!}
    </div>

    {{-- Disclaimer --}}
    <div style="background:#FAEEDA;border-radius:12px;padding:1rem 1.25rem;font-size:.825rem;color:#633806;margin-bottom:1.25rem">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Disclaimer:</strong> Artikel ini hanya untuk tujuan edukasi dan tidak menggantikan saran medis profesional. Konsultasikan kondisi kulitmu dengan dokter kulit untuk penanganan yang tepat.
    </div>

    {{-- Artikel terkait --}}
    @if($related->count() > 0)
    <div style="background:#fff;border:1px solid var(--ac-border);border-radius:20px;padding:1.5rem">
        <div style="font-size:1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1rem">
            <i class="bi bi-collection me-2 text-ac"></i>Artikel Terkait
        </div>
        @foreach($related as $r)
        <a href="{{ route('artikel.detail', $r->slug) }}" class="related-card">
            <div style="font-size:.875rem;font-weight:600;color:var(--ac-green-dark)">{{ $r->judul }}</div>
            <div style="font-size:.775rem;color:var(--ac-muted);margin-top:3px">{{ $r->created_at->format('d M Y') }}</div>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection