@extends('layouts.app')
@section('title', 'Beranda')

@push('styles')
<style>
    /* ── HERO ── */
    .hero-section {
        background: linear-gradient(135deg, #F0FBF7 0%, #E1F5EE 50%, #F8FDFB 100%);
        padding: 5rem 0 4rem;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(29,158,117,0.08) 0%, transparent 70%);
        top: -100px; right: -100px;
        border-radius: 50%;
    }
    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--ac-green-light);
        color: var(--ac-green-dark);
        border: 1px solid var(--ac-green-mid);
        border-radius: 999px;
        padding: 4px 14px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
    }
    .hero-title {
        font-size: clamp(2rem, 5vw, 3.25rem);
        font-weight: 700;
        line-height: 1.2;
        color: var(--ac-green-dark);
        margin-bottom: 1.25rem;
    }
    .hero-title .highlight {
        color: var(--ac-green);
        position: relative;
    }
    .hero-desc {
        font-size: 1.05rem;
        color: var(--ac-muted);
        line-height: 1.8;
        max-width: 520px;
        margin-bottom: 2rem;
    }
    .hero-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid var(--ac-border);
    }
    .hero-stat-num {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--ac-green-dark);
    }
    .hero-stat-label {
        font-size: 0.8rem;
        color: var(--ac-muted);
        margin-top: 1px;
    }
    .hero-visual {
        background: #fff;
        border: 1px solid var(--ac-border);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 20px 60px rgba(29,158,117,0.1);
    }
    .skin-card {
        background: var(--ac-green-light);
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .skin-card-icon {
        width: 38px; height: 38px;
        background: var(--ac-green);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .skin-card-title { font-size: 0.85rem; font-weight: 600; color: var(--ac-green-dark); }
    .skin-card-sub { font-size: 0.75rem; color: var(--ac-muted); }
    .rating-dots {
        display: flex; gap: 4px; margin-top: 4px;
    }
    .rating-dots span {
        width: 8px; height: 8px; border-radius: 50%;
    }

    /* ── FITUR ── */
    .section-eyebrow {
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--ac-green);
        margin-bottom: 0.5rem;
    }
    .section-title {
        font-size: clamp(1.5rem, 3vw, 2.25rem);
        font-weight: 700;
        color: var(--ac-green-dark);
        margin-bottom: 0.75rem;
    }
    .section-desc {
        color: var(--ac-muted);
        font-size: 0.95rem;
        max-width: 540px;
        margin: 0 auto;
        line-height: 1.7;
    }
    .feature-card {
        background: #fff;
        border: 1px solid var(--ac-border);
        border-radius: 16px;
        padding: 1.75rem;
        height: 100%;
        transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    }
    .feature-card:hover {
        border-color: var(--ac-green-mid);
        box-shadow: 0 8px 32px rgba(29,158,117,0.1);
        transform: translateY(-3px);
    }
    .feature-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1.1rem;
    }
    .feature-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--ac-green-dark);
        margin-bottom: 0.5rem;
    }
    .feature-desc {
        font-size: 0.875rem;
        color: var(--ac-muted);
        line-height: 1.7;
        margin: 0;
    }

    /* ── CARA KERJA ── */
    .how-section { background: var(--ac-bg); }
    .step-number {
        width: 48px; height: 48px;
        background: var(--ac-green);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(29,158,117,0.3);
    }
    .step-title { font-size: 1rem; font-weight: 700; color: var(--ac-green-dark); margin-bottom: 0.35rem; }
    .step-desc { font-size: 0.875rem; color: var(--ac-muted); line-height: 1.7; margin: 0; }

    /* ── JENIS JERAWAT ── */
    .acne-card {
        background: #fff;
        border: 1px solid var(--ac-border);
        border-radius: 14px;
        padding: 1.25rem;
        text-align: center;
        transition: all 0.2s;
    }
    .acne-card:hover {
        border-color: var(--ac-green-mid);
        box-shadow: 0 4px 20px rgba(29,158,117,0.1);
    }
    .acne-emoji { font-size: 2rem; margin-bottom: 0.75rem; }
    .acne-name { font-size: 0.95rem; font-weight: 700; color: var(--ac-green-dark); margin-bottom: 0.35rem; }
    .acne-desc { font-size: 0.8rem; color: var(--ac-muted); line-height: 1.6; margin: 0; }

    /* ── CTA ── */
    .cta-section {
        background: linear-gradient(135deg, var(--ac-green-dark) 0%, var(--ac-green) 100%);
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        top: -150px; right: -100px;
    }
    .btn-cta-white {
        background: #fff;
        color: var(--ac-green-dark);
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        padding: 0.8rem 2rem;
        transition: all 0.2s;
    }
    .btn-cta-white:hover {
        background: var(--ac-green-light);
        color: var(--ac-green-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }
</style>
@endpush

@section('content')

{{-- ── HERO SECTION ── --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-eyebrow">
                    <i class="bi bi-shield-check-fill"></i>
                    Platform Kesehatan Kulit #1
                </div>
                <h1 class="hero-title">
                    Kenali Kulitmu,<br>
                    <span class="highlight">Atasi Jerawat</span><br>
                    dengan Tepat
                </h1>
                <p class="hero-desc">
                    Catat kondisi kulit harian, konsultasi jenis jerawat dengan sistem pakar,
                    dan dapatkan rekomendasi produk yang sesuai kondisi kulitmu.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('register') }}" class="btn btn-ac-primary px-4 py-2" style="font-size:1rem">
                        <i class="bi bi-rocket-takeoff me-2"></i>Mulai Sekarang — Gratis
                    </a>
                    <a href="{{ url('/konsultasi') }}" class="btn btn-ac-outline px-4 py-2" style="font-size:1rem">
                        <i class="bi bi-search-heart me-2"></i>Coba Konsultasi
                    </a>
                </div>
                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-num">4+</div>
                        <div class="hero-stat-label">Jenis Jerawat Terdeteksi</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">100%</div>
                        <div class="hero-stat-label">Gratis Digunakan</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">24/7</div>
                        <div class="hero-stat-label">Akses Kapan Saja</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div style="width:10px;height:10px;border-radius:50%;background:#ff5f57"></div>
                        <div style="width:10px;height:10px;border-radius:50%;background:#febc2e"></div>
                        <div style="width:10px;height:10px;border-radius:50%;background:#28c840"></div>
                        <span style="font-size:0.75rem;color:var(--ac-muted);margin-left:6px">Dashboard AcneCare</span>
                    </div>
                    <div class="skin-card">
                        <div class="skin-card-icon"><i class="bi bi-journal-text"></i></div>
                        <div>
                            <div class="skin-card-title">Jurnal Hari Ini</div>
                            <div class="skin-card-sub">Kondisi kulit: membaik</div>
                            <div class="rating-dots">
                                <span style="background:var(--ac-green)"></span>
                                <span style="background:var(--ac-green)"></span>
                                <span style="background:var(--ac-green)"></span>
                                <span style="background:var(--ac-green-mid)"></span>
                                <span style="background:var(--ac-border)"></span>
                            </div>
                        </div>
                    </div>
                    <div class="skin-card">
                        <div class="skin-card-icon"><i class="bi bi-clipboard2-pulse"></i></div>
                        <div>
                            <div class="skin-card-title">Hasil Konsultasi</div>
                            <div class="skin-card-sub">Terdeteksi: Papula — 3 produk direkomendasikan</div>
                        </div>
                    </div>
                    <div class="skin-card" style="background:#fff;border:1px solid var(--ac-border)">
                        <div class="skin-card-icon" style="background:#E6F1FB">
                            <i class="bi bi-box-seam" style="color:#185FA5"></i>
                        </div>
                        <div>
                            <div class="skin-card-title" style="color:#185FA5">Rekomendasi Produk</div>
                            <div class="skin-card-sub">Salicylic Acid 2% • Niacinamide 10%</div>
                        </div>
                    </div>
                    <div style="background:var(--ac-green-light);border-radius:10px;padding:.75rem 1rem;font-size:0.8rem;color:var(--ac-green-dark)">
                        <i class="bi bi-graph-up-arrow me-2"></i>
                        <strong>Progres minggu ini:</strong> Kondisi kulit naik 20% lebih baik!
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── FITUR UNGGULAN ── --}}
<section class="py-6" style="padding:5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-eyebrow">Fitur Unggulan</div>
            <h2 class="section-title">Semua yang Kamu Butuhkan<br>untuk Kulit Sehat</h2>
            <p class="section-desc">Dari catatan harian hingga konsultasi pintar — semuanya dalam satu platform yang mudah digunakan.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#E1F5EE">
                        <i class="bi bi-journal-heart" style="color:var(--ac-green)"></i>
                    </div>
                    <div class="feature-title">Jurnal Kulit Harian</div>
                    <p class="feature-desc">Catat kondisi kulit setiap hari lengkap dengan foto progres dan rating keparahan 1–5.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#EEEDFE">
                        <i class="bi bi-clipboard2-data" style="color:#534AB7"></i>
                    </div>
                    <div class="feature-title">Sistem Pakar Jerawat</div>
                    <p class="feature-desc">Jawab pertanyaan Ya/Tidak dan sistem kami identifikasi jenis jerawatmu secara akurat.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#E6F1FB">
                        <i class="bi bi-bag-heart" style="color:#185FA5"></i>
                    </div>
                    <div class="feature-title">Rekomendasi Produk</div>
                    <p class="feature-desc">Dapatkan rekomendasi produk skincare yang tepat berdasarkan hasil konsultasi kulitmu.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#FAECE7">
                        <i class="bi bi-people-fill" style="color:#D85A30"></i>
                    </div>
                    <div class="feature-title">Forum Komunitas</div>
                    <p class="feature-desc">Berbagi pengalaman dan tips dengan sesama pengguna yang memiliki masalah kulit serupa.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── CARA KERJA ── --}}
<section class="how-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-eyebrow">Cara Kerja</div>
            <h2 class="section-title">Mulai dalam 3 Langkah Mudah</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="d-flex gap-3">
                    <div class="step-number">1</div>
                    <div>
                        <div class="step-title">Daftar Akun Gratis</div>
                        <p class="step-desc">Buat akun dalam 1 menit. Tidak perlu kartu kredit — sepenuhnya gratis untuk semua fitur utama.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-3">
                    <div class="step-number">2</div>
                    <div>
                        <div class="step-title">Isi Jurnal & Konsultasi</div>
                        <p class="step-desc">Catat kondisi kulitmu setiap hari dan jawab pertanyaan konsultasi untuk kenali jenis jerawatmu.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex gap-3">
                    <div class="step-number">3</div>
                    <div>
                        <div class="step-title">Dapat Rekomendasi Tepat</div>
                        <p class="step-desc">Terima rekomendasi produk yang sesuai kondisi kulitmu dan pantau progres perbaikan kulitmu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── JENIS JERAWAT ── --}}
<section style="padding:5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-eyebrow">Edukasi Jerawat</div>
            <h2 class="section-title">Kenali Jenis Jerawatmu</h2>
            <p class="section-desc">AcneCare membantu mengidentifikasi 4 jenis jerawat paling umum dan cara penanganannya.</p>
        </div>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="acne-card">
                    <div class="acne-emoji">🔴</div>
                    <div class="acne-name">Papula</div>
                    <p class="acne-desc">Benjolan merah kecil, padat, dan terasa nyeri saat disentuh.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="acne-card">
                    <div class="acne-emoji">🟡</div>
                    <div class="acne-name">Pustula</div>
                    <p class="acne-desc">Benjolan berisi nanah berwarna putih atau kuning di permukaannya.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="acne-card">
                    <div class="acne-emoji">⚫</div>
                    <div class="acne-name">Komedo</div>
                    <p class="acne-desc">Pori tersumbat sebum — bisa berupa titik hitam atau putih.</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="acne-card">
                    <div class="acne-emoji">🟤</div>
                    <div class="acne-name">Nodul</div>
                    <p class="acne-desc">Benjolan keras di bawah kulit, terasa nyeri, dan lebih dalam.</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ url('/konsultasi') }}" class="btn btn-ac-outline px-4 py-2">
                <i class="bi bi-arrow-right-circle me-2"></i>Cek Jenis Jerawatmu Sekarang
            </a>
        </div>
    </div>
</section>

{{-- ── CTA SECTION ── --}}
<section class="cta-section">
    <div class="container text-center position-relative">
        <div style="display:inline-block;background:rgba(255,255,255,0.15);border-radius:999px;padding:4px 16px;font-size:0.8rem;font-weight:600;color:rgba(255,255,255,0.9);margin-bottom:1.25rem">
            ✨ Gratis Selamanya
        </div>
        <h2 style="font-size:clamp(1.75rem,4vw,2.75rem);font-weight:700;color:#fff;margin-bottom:1rem;line-height:1.2">
            Mulai Perjalanan Kulit Sehatmu<br>Hari Ini!
        </h2>
        <p style="color:rgba(255,255,255,0.75);font-size:1rem;max-width:480px;margin:0 auto 2rem;line-height:1.7">
            Bergabung dan mulai catat kondisi kulitmu, konsultasi gratis, serta dapatkan rekomendasi produk yang tepat.
        </p>
        <a href="{{ route('register') }}" class="btn btn-cta-white px-5">
            <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang — Gratis
        </a>
        <div style="margin-top:1.5rem;font-size:0.8rem;color:rgba(255,255,255,0.55)">
            <i class="bi bi-shield-check me-1"></i>Tidak perlu kartu kredit &nbsp;·&nbsp;
            <i class="bi bi-lock me-1"></i>Data aman & pribadi
        </div>
    </div>
</section>

@endsection