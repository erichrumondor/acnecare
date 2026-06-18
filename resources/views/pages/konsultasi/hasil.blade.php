@extends('layouts.app')
@section('title', 'Hasil Konsultasi')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .hasil-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; margin-bottom:1.25rem; }
    .hasil-badge { display:inline-flex; align-items:center; gap:8px; padding:.5rem 1.25rem; border-radius:999px; font-size:.875rem; font-weight:700; margin-bottom:1rem; }
    .keparahan-ringan { background:#E1F5EE; color:#085041; }
    .keparahan-sedang { background:#FAEEDA; color:#633806; }
    .keparahan-berat  { background:#FAECE7; color:#993C1D; }
    .info-row { display:flex; gap:1rem; margin-bottom:1.25rem; flex-wrap:wrap; }
    .info-item { flex:1; min-width:140px; background:var(--ac-green-light); border-radius:12px; padding:.875rem 1rem; }
    .info-item .label { font-size:.75rem; color:var(--ac-muted); margin-bottom:.25rem; }
    .info-item .value { font-size:.95rem; font-weight:700; color:var(--ac-green-dark); }
    .produk-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1rem 1.25rem; display:flex; align-items:center; gap:12px; margin-bottom:.75rem; transition:all .2s; }
    .produk-card:hover { border-color:var(--ac-green-mid); }
    .produk-icon { width:44px; height:44px; background:var(--ac-green-light); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; flex-shrink:0; }
    .saran-list { list-style:none; padding:0; margin:0; }
    .saran-list li { display:flex; align-items:flex-start; gap:10px; padding:.6rem 0; border-bottom:.5px solid var(--ac-border); font-size:.875rem; color:#374151; }
    .saran-list li:last-child { border-bottom:none; }
    .saran-list li i { color:var(--ac-green); margin-top:2px; flex-shrink:0; }
</style>
@endpush

@section('content')
<div class="ac-main">
    {{-- Header hasil --}}
    <div class="hasil-card">
        <div style="text-align:center;padding:1rem 0">
            <div style="font-size:3.5rem;margin-bottom:1rem">
                @switch($hasil->hasil)
                    @case('komedo_hitam') ⚫ @break
                    @case('komedo_putih') ⚪ @break
                    @case('papula')       🔴 @break
                    @case('pustula')      🟡 @break
                    @case('nodul')        🟤 @break
                    @default              ❓
                @endswitch
            </div>
            <div class="hasil-badge keparahan-{{ $hasil->keparahan ?? 'ringan' }}">
                <i class="bi bi-patch-check-fill"></i>
                Terdeteksi: {{ $hasil->hasil_label }}
            </div>
            <p style="font-size:.875rem;color:var(--ac-muted);max-width:400px;margin:.5rem auto 0;line-height:1.7">
                @switch($hasil->hasil)
                    @case('komedo_hitam')
                        Pori-pori terbuka yang tersumbat oleh sebum yang teroksidasi, menyebabkan warna hitam di permukaan kulit.
                        @break
                    @case('komedo_putih')
                        Pori-pori tertutup yang tersumbat oleh sebum dan sel kulit mati, tampak sebagai titik putih kecil.
                        @break
                    @case('papula')
                        Benjolan merah kecil yang terjadi akibat inflamasi ringan. Tidak berisi nanah dan terasa sedikit nyeri.
                        @break
                    @case('pustula')
                        Benjolan berisi nanah berwarna putih atau kuning akibat inflamasi sedang dan infeksi bakteri.
                        @break
                    @case('nodul')
                        Benjolan keras yang terbentuk jauh di bawah kulit. Merupakan inflamasi berat yang memerlukan penanganan dokter.
                        @break
                    @default
                        Kondisi kulitmu tidak dapat diidentifikasi. Disarankan untuk berkonsultasi langsung dengan dokter kulit.
                @endswitch
            </p>
        </div>

        <div class="info-row">
            <div class="info-item">
                <div class="label">Tingkat Keparahan</div>
                <div class="value">{{ ucfirst($hasil->keparahan ?? '-') }}</div>
            </div>
            <div class="info-item">
                <div class="label">Tanggal Konsultasi</div>
                <div class="value">{{ $hasil->created_at->format('d M Y') }}</div>
            </div>
            <div class="info-item">
                <div class="label">Referensi</div>
                <div class="value">AAD Classification</div>
            </div>
        </div>

        {{-- Disclaimer --}}
        <div style="background:#FAEEDA;border-radius:10px;padding:.875rem 1rem;font-size:.8rem;color:#633806">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Penting:</strong> Hasil ini bukan diagnosis medis. Konsultasikan ke dokter kulit untuk penanganan yang tepat, terutama jika kondisi parah atau tidak membaik.
        </div>
    </div>

    {{-- Saran penanganan --}}
    <div class="hasil-card">
        <div style="font-size:1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1rem">
            <i class="bi bi-journal-medical me-2 text-ac"></i>Saran Penanganan
        </div>
        <ul class="saran-list">
            @switch($hasil->hasil)
                @case('komedo_hitam')
                @case('komedo_putih')
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan pembersih wajah berbahan salicylic acid 1-2%</li>
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan exfoliator kimia (BHA) 1-2x seminggu</li>
                    <li><i class="bi bi-check-circle-fill"></i>Hindari produk berbasis minyak (non-comedogenic)</li>
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan retinol di malam hari secara bertahap</li>
                    @break
                @case('papula')
                    <li><i class="bi bi-check-circle-fill"></i>Jangan memencet atau menyentuh jerawat</li>
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan spot treatment berbahan benzoyl peroxide 2.5%</li>
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan niacinamide untuk mengurangi kemerahan</li>
                    <li><i class="bi bi-check-circle-fill"></i>Kompres es batu yang dibungkus kain jika terasa nyeri</li>
                    @break
                @case('pustula')
                    <li><i class="bi bi-check-circle-fill"></i>Jangan memencet — dapat menyebabkan bekas luka</li>
                    <li><i class="bi bi-check-circle-fill"></i>Gunakan spot treatment benzoyl peroxide 5%</li>
                    <li><i class="bi bi-check-circle-fill"></i>Pertimbangkan konsultasi ke dokter kulit</li>
                    <li><i class="bi bi-check-circle-fill"></i>Jaga kebersihan sarung bantal dan handuk wajah</li>
                    @break
                @case('nodul')
                    <li><i class="bi bi-exclamation-circle-fill" style="color:#D85A30"></i><strong>Segera konsultasi ke dokter kulit</strong></li>
                    <li><i class="bi bi-check-circle-fill"></i>Jangan memencet — dapat menyebabkan jaringan parut permanen</li>
                    <li><i class="bi bi-check-circle-fill"></i>Dokter mungkin akan meresepkan antibiotik atau retinoid oral</li>
                    <li><i class="bi bi-check-circle-fill"></i>Hindari paparan sinar matahari berlebihan</li>
                    @break
                @default
                    <li><i class="bi bi-check-circle-fill"></i>Konsultasikan langsung ke dokter kulit</li>
                    <li><i class="bi bi-check-circle-fill"></i>Jaga kebersihan wajah dengan pembersih yang lembut</li>
            @endswitch
        </ul>
    </div>

    {{-- Rekomendasi produk --}}
    @if($produk->count() > 0)
    <div class="hasil-card">
        <div style="font-size:1rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1rem">
            <i class="bi bi-bag-heart me-2 text-ac"></i>Produk yang Direkomendasikan
        </div>
        @foreach($produk as $p)
        <div class="produk-card">
            <div class="produk-icon">
                @switch($p->kategori)
                    @case('serum') 💧 @break
                    @case('cleanser') 🧴 @break
                    @case('moisturizer') 🌿 @break
                    @case('sunscreen') ☀️ @break
                    @case('spot_treatment') 🎯 @break
                    @default 📦
                @endswitch
            </div>
            <div class="flex-grow-1">
                <div style="font-size:.9rem;font-weight:600;color:var(--ac-green-dark)">{{ $p->nama }}</div>
                <div style="font-size:.775rem;color:var(--ac-muted)">{{ $p->merek }} · {{ ucfirst($p->kategori) }}</div>
            </div>
            @if($p->harga)
            <div style="font-size:.875rem;font-weight:600;color:var(--ac-green)">
                Rp {{ number_format($p->harga, 0, ',', '.') }}
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="hasil-card" style="text-align:center;padding:2rem">
        <i class="bi bi-bag-x" style="font-size:2rem;color:var(--ac-muted)"></i>
        <p style="font-size:.875rem;color:var(--ac-muted);margin-top:.75rem">
            Belum ada produk yang direkomendasikan untuk jenis jerawat ini.
        </p>
    </div>
    @endif

    {{-- Tombol aksi --}}
    <div class="d-flex gap-3 mt-2">
        <a href="{{ route('konsultasi.mulai') }}" class="btn btn-ac-primary flex-grow-1 py-2">
            <i class="bi bi-arrow-repeat me-2"></i>Konsultasi Ulang
        </a>
        <a href="{{ route('jurnal.buat') }}" class="btn btn-ac-outline py-2 px-4">
            <i class="bi bi-journal-plus me-1"></i>Catat di Jurnal
        </a>
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('konsultasi.riwayat') }}" style="font-size:.8rem;color:var(--ac-muted)">
            Lihat semua riwayat konsultasi →
        </a>
    </div>
</div>
@endsection