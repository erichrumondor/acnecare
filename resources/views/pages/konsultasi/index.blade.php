@extends('layouts.app')
@section('title', 'Konsultasi Jerawat')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .warning-card { background:#FAEEDA; border:1px solid #FAC775; border-radius:16px; padding:1.5rem; margin-bottom:1.5rem; }
    .warning-item { display:flex; align-items:flex-start; gap:10px; margin-bottom:.75rem; font-size:.875rem; color:#633806; }
    .warning-item:last-child { margin-bottom:0; }
    .warning-item i { font-size:1rem; margin-top:2px; flex-shrink:0; }
    .info-card { background:#fff; border:1px solid var(--ac-border); border-radius:16px; padding:1.5rem; margin-bottom:1.5rem; }
    .jerawat-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:10px; margin-top:1rem; }
    .jerawat-item { background:var(--ac-green-light); border-radius:10px; padding:.75rem 1rem; }
    .jerawat-item .nama { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); }
    .jerawat-item .desc { font-size:.775rem; color:var(--ac-muted); margin-top:2px; }
    .riwayat-card { background:#fff; border:1px solid var(--ac-border); border-radius:12px; padding:1rem 1.25rem; margin-bottom:.75rem; display:flex; align-items:center; justify-content:space-between; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="{{ url('/dashboard') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i> Dashboard
        </a>
    </div>

    <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.35rem">
        <i class="bi bi-clipboard2-pulse me-2"></i>Konsultasi Jerawat
    </h1>
    <p style="font-size:.875rem;color:var(--ac-muted);margin-bottom:1.5rem">
        Identifikasi jenis jerawatmu melalui 8 pertanyaan singkat berdasarkan klasifikasi AAD.
    </p>

    {{-- Peringatan --}}
    <div class="warning-card">
        <div style="font-size:.9rem;font-weight:700;color:#633806;margin-bottom:1rem">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Perhatian Sebelum Mulai
        </div>
        <div class="warning-item">
            <i class="bi bi-hand-index"></i>
            <span>Cuci tangan dengan sabun sebelum menyentuh atau memeriksa area jerawat</span>
        </div>
        <div class="warning-item">
            <i class="bi bi-lightbulb"></i>
            <span>Lakukan pemeriksaan di depan cermin dengan pencahayaan yang cukup terang</span>
        </div>
        <div class="warning-item">
            <i class="bi bi-slash-circle"></i>
            <span>Jangan memencet atau menekan jerawat sebelum dan sesudah pemeriksaan</span>
        </div>
        <div class="warning-item">
            <i class="bi bi-camera"></i>
            <span>Foto kondisi kulit dalam cahaya natural untuk referensi terbaik</span>
        </div>
        <div class="warning-item">
            <i class="bi bi-hospital"></i>
            <span>Hasil ini bukan diagnosis medis — konsultasikan ke dokter kulit untuk penanganan lebih lanjut</span>
        </div>
        <div class="warning-item">
            <i class="bi bi-patch-check"></i>
            <span>Jawab setiap pertanyaan dengan jujur sesuai kondisi kulitmu saat ini</span>
        </div>
    </div>

    {{-- Info jerawat --}}
    <div class="info-card">
        <div style="font-size:.9rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.5rem">
            <i class="bi bi-info-circle me-2 text-ac"></i>Jenis Jerawat yang Dapat Dideteksi
        </div>
        <p style="font-size:.825rem;color:var(--ac-muted);margin-bottom:.75rem">
            Berdasarkan klasifikasi <strong>American Academy of Dermatology (AAD)</strong>
        </p>
        <div class="jerawat-grid">
            <div class="jerawat-item">
                <div class="nama">⚫ Komedo Hitam</div>
                <div class="desc">Pori terbuka tersumbat sebum teroksidasi</div>
            </div>
            <div class="jerawat-item">
                <div class="nama">⚪ Komedo Putih</div>
                <div class="desc">Pori tertutup tersumbat sebum & sel kulit mati</div>
            </div>
            <div class="jerawat-item">
                <div class="nama">🔴 Papula</div>
                <div class="desc">Benjolan merah kecil tanpa nanah, inflamasi ringan</div>
            </div>
            <div class="jerawat-item">
                <div class="nama">🟡 Pustula</div>
                <div class="desc">Benjolan berisi nanah putih/kuning, inflamasi sedang</div>
            </div>
            <div class="jerawat-item" style="grid-column:span 2">
                <div class="nama">🟤 Nodul</div>
                <div class="desc">Benjolan keras dalam di bawah kulit, sangat nyeri, inflamasi berat</div>
            </div>
        </div>
    </div>

    {{-- Riwayat terakhir --}}
    @if($riwayat->count() > 0)
    <div class="info-card">
        <div style="font-size:.9rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1rem">
            <i class="bi bi-clock-history me-2 text-ac"></i>Konsultasi Terakhir
        </div>
        @foreach($riwayat as $r)
        <div class="riwayat-card">
            <div>
                <div style="font-size:.875rem;font-weight:600;color:var(--ac-green-dark)">{{ $r->hasil_label }}</div>
                <div style="font-size:.775rem;color:var(--ac-muted)">{{ $r->created_at->diffForHumans() }}</div>
            </div>
            <a href="{{ route('konsultasi.hasil', $r->id) }}" class="btn btn-ac-outline btn-sm" style="font-size:.8rem">
                Lihat hasil
            </a>
        </div>
        @endforeach
        <a href="{{ route('konsultasi.riwayat') }}" style="font-size:.8rem;color:var(--ac-green)">
            Lihat semua riwayat →
        </a>
    </div>
    @endif

    {{-- Tombol mulai --}}
    <div class="text-center mt-2">
        <a href="{{ route('konsultasi.mulai') }}" class="btn btn-ac-primary px-5 py-2" style="font-size:1rem">
            <i class="bi bi-play-fill me-2"></i>Mulai Konsultasi
        </a>
        <div style="font-size:.775rem;color:var(--ac-muted);margin-top:.75rem">
            <i class="bi bi-clock me-1"></i>Estimasi waktu: 2–3 menit
        </div>
    </div>
</div>
@endsection