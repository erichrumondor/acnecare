@extends('layouts.app')
@section('title', 'Detail Jurnal')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .detail-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .detail-photo { width:100%; max-height:300px; object-fit:cover; border-radius:14px; margin-bottom:1.5rem; }
    .info-row { display:flex; justify-content:space-between; align-items:center; padding:.875rem 0; border-bottom:1px solid var(--ac-border); font-size:.875rem; }
    .info-row:last-child { border-bottom:none; }
    .info-label { color:var(--ac-muted); font-weight:500; }
    .rating-stars i { font-size:1.1rem; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="{{ route('jurnal.index') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Jurnal
        </a>
    </div>

    <div class="detail-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h1 style="font-size:1.25rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                    Jurnal {{ $jurnal->tanggal->translatedFormat('d F Y') }}
                </h1>
                <div style="font-size:.8rem;color:var(--ac-muted);margin-top:3px">
                    Dicatat pada {{ $jurnal->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('jurnal.edit', $jurnal->id) }}" class="btn btn-sm btn-ac-outline">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
                <form method="POST" action="{{ route('jurnal.hapus', $jurnal->id) }}" onsubmit="return confirm('Yakin hapus jurnal ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm" style="background:#FAECE7;color:#D85A30;border-radius:8px">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        @if($jurnal->foto)
            <img src="{{ Storage::url($jurnal->foto) }}" alt="Foto kondisi kulit" class="detail-photo">
        @endif

        <div class="info-row">
            <span class="info-label"><i class="bi bi-calendar3 me-2"></i>Tanggal</span>
            <span style="font-weight:600;color:var(--ac-green-dark)">{{ $jurnal->tanggal->translatedFormat('l, d F Y') }}</span>
        </div>

        <div class="info-row">
            <span class="info-label"><i class="bi bi-star me-2"></i>Rating</span>
            <div class="d-flex align-items-center gap-2">
                <div class="rating-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill" style="color:{{ $i <= $jurnal->rating ? '#F59E0B' : '#E5E7EB' }}"></i>
                    @endfor
                </div>
                <span style="font-weight:600;color:var(--ac-green-dark)">{{ $jurnal->rating }}/5 — {{ $jurnal->rating_label }}</span>
            </div>
        </div>

        <div class="info-row">
            <span class="info-label"><i class="bi bi-activity me-2"></i>Kondisi</span>
            <span class="badge rounded-pill
                @if($jurnal->kondisi == 'membaik') bg-success
                @elseif($jurnal->kondisi == 'memburuk') bg-danger
                @else bg-warning text-dark @endif"
                style="font-size:.8rem;padding:5px 14px">
                {{ ucfirst($jurnal->kondisi) }}
            </span>
        </div>

        @if($jurnal->catatan)
        <div style="margin-top:1.25rem;padding:1.25rem;background:var(--ac-green-light);border-radius:12px">
            <div style="font-size:.8rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.06em">
                <i class="bi bi-pencil-square me-1"></i> Catatan
            </div>
            <p style="font-size:.9rem;color:var(--ac-text);line-height:1.7;margin:0">{{ $jurnal->catatan }}</p>
        </div>
        @endif
    </div>
</div>
@endsection