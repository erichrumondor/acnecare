@extends('layouts.app')
@section('title', 'Riwayat Konsultasi')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .riwayat-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1.25rem; margin-bottom:.75rem; display:flex; align-items:center; justify-content:space-between; gap:1rem; transition:all .2s; }
    .riwayat-card:hover { border-color:var(--ac-green-mid); box-shadow:0 4px 16px rgba(29,158,117,.08); }
    .hasil-emoji { font-size:1.75rem; flex-shrink:0; }
    .keparahan-badge { font-size:.72rem; padding:2px 10px; border-radius:999px; font-weight:600; }
    .ringan { background:#E1F5EE; color:#085041; }
    .sedang { background:#FAEEDA; color:#633806; }
    .berat  { background:#FAECE7; color:#993C1D; }
    .empty-state { text-align:center; padding:4rem 2rem; background:#fff; border:1px dashed var(--ac-border); border-radius:16px; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                <i class="bi bi-clock-history me-2"></i>Riwayat Konsultasi
            </h1>
            <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">
                Total {{ $riwayat->total() }} konsultasi
            </p>
        </div>
        <a href="{{ route('konsultasi.mulai') }}" class="btn btn-ac-primary">
            <i class="bi bi-plus-lg me-1"></i>Konsultasi Baru
        </a>
    </div>

    @if($riwayat->count() > 0)
        @foreach($riwayat as $r)
        <div class="riwayat-card">
            <div class="hasil-emoji">
                @switch($r->hasil)
                    @case('komedo_hitam') ⚫ @break
                    @case('komedo_putih') ⚪ @break
                    @case('papula')       🔴 @break
                    @case('pustula')      🟡 @break
                    @case('nodul')        🟤 @break
                    @default              ❓
                @endswitch
            </div>
            <div class="flex-grow-1">
                <div style="font-size:.9rem;font-weight:600;color:var(--ac-green-dark)">
                    {{ $r->hasil_label }}
                </div>
                <div style="font-size:.775rem;color:var(--ac-muted);margin-top:2px">
                    <i class="bi bi-calendar3 me-1"></i>{{ $r->created_at->format('d M Y, H:i') }}
                </div>
            </div>
            <span class="keparahan-badge {{ $r->keparahan ?? 'ringan' }}">
                {{ ucfirst($r->keparahan ?? 'ringan') }}
            </span>
            <a href="{{ route('konsultasi.hasil', $r->id) }}" class="btn btn-ac-outline btn-sm" style="font-size:.8rem;white-space:nowrap">
                <i class="bi bi-eye me-1"></i>Detail
            </a>
        </div>
        @endforeach

        <div class="mt-3">{{ $riwayat->links() }}</div>
    @else
        <div class="empty-state">
            <div style="font-size:3rem;margin-bottom:1rem">🔍</div>
            <h3 style="font-size:1.1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.5rem">
                Belum ada riwayat konsultasi
            </h3>
            <p style="font-size:.875rem;color:var(--ac-muted);max-width:300px;margin:0 auto 1.5rem;line-height:1.7">
                Mulai konsultasi untuk mengidentifikasi jenis jerawatmu.
            </p>
            <a href="{{ route('konsultasi.mulai') }}" class="btn btn-ac-primary">
                <i class="bi bi-play-fill me-2"></i>Mulai Konsultasi
            </a>
        </div>
    @endif
</div>
@endsection