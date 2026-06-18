@extends('layouts.app')
@section('title', 'Dashboard')

@push('styles')
<style>
    body { background: #F8FDFB; }
    .ac-sidebar {
        width: 240px; min-height: calc(100vh - 64px);
        background: #fff; border-right: 1px solid var(--ac-border);
        padding: 1.5rem 0; position: fixed; top: 64px; left: 0; z-index: 100;
    }
    .sidebar-section { padding: 0 1rem; margin-bottom: 1.5rem; }
    .sidebar-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--ac-muted); padding: 0 0.75rem; margin-bottom: 0.4rem; }
    .sidebar-link { display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.75rem; border-radius: 10px; font-size: 0.875rem; font-weight: 500; color: var(--ac-muted); text-decoration: none; transition: all 0.15s; margin-bottom: 2px; }
    .sidebar-link:hover { background: var(--ac-green-light); color: var(--ac-green-dark); }
    .sidebar-link.active { background: var(--ac-green-light); color: var(--ac-green-dark); font-weight: 600; }
    .sidebar-link i { font-size: 1.05rem; width: 20px; text-align: center; }
    .sidebar-user { padding: 1rem; margin: 0 1rem 1.5rem; background: var(--ac-green-light); border-radius: 12px; }
    .sidebar-avatar { width: 36px; height: 36px; background: var(--ac-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.9rem; flex-shrink: 0; }
    .ac-main { margin-left: 240px; padding: 2rem; min-height: calc(100vh - 64px); }
    .stat-card { background: #fff; border: 1px solid var(--ac-border); border-radius: 16px; padding: 1.25rem 1.5rem; transition: box-shadow 0.2s; }
    .stat-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
    .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1rem; }
    .stat-number { font-size: 1.75rem; font-weight: 700; color: var(--ac-green-dark); line-height: 1; }
    .stat-label { font-size: 0.8rem; color: var(--ac-muted); margin-top: 4px; }
    .stat-change { font-size: 0.75rem; font-weight: 600; margin-top: 0.5rem; display: flex; align-items: center; gap: 3px; }
    .ac-card { background: #fff; border: 1px solid var(--ac-border); border-radius: 16px; padding: 1.5rem; height: 100%; }
    .ac-card-title { font-size: 0.95rem; font-weight: 700; color: var(--ac-green-dark); margin-bottom: 1.25rem; display: flex; align-items: center; justify-content: space-between; }
    .ac-card-title a { font-size: 0.775rem; font-weight: 500; color: var(--ac-green); text-decoration: none; }
    .journal-item { display: flex; align-items: flex-start; gap: 12px; padding: 0.875rem 0; border-bottom: 1px solid var(--ac-border); }
    .journal-item:last-child { border-bottom: none; padding-bottom: 0; }
    .journal-date { background: var(--ac-green-light); border-radius: 10px; padding: 6px 10px; text-align: center; flex-shrink: 0; min-width: 48px; }
    .journal-day { font-size: 1.1rem; font-weight: 700; color: var(--ac-green-dark); line-height: 1; }
    .journal-month { font-size: 0.65rem; color: var(--ac-muted); text-transform: uppercase; }
    .journal-title { font-size: 0.875rem; font-weight: 600; color: var(--ac-text); }
    .journal-note { font-size: 0.8rem; color: var(--ac-muted); margin-top: 2px; }
    .rating-bar { display: flex; gap: 3px; margin-top: 5px; }
    .rating-bar span { width: 14px; height: 5px; border-radius: 2px; background: var(--ac-border); }
    .rating-bar span.filled { background: var(--ac-green); }
    .product-item { display: flex; align-items: center; gap: 12px; padding: 0.75rem 0; border-bottom: 1px solid var(--ac-border); }
    .product-item:last-child { border-bottom: none; }
    .product-icon { width: 40px; height: 40px; border-radius: 10px; background: var(--ac-green-light); display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; color: var(--ac-green); }
    .product-name { font-size: 0.875rem; font-weight: 600; color: var(--ac-text); }
    .product-type { font-size: 0.75rem; color: var(--ac-muted); }
    .product-badge { margin-left: auto; font-size: 0.7rem; padding: 3px 10px; border-radius: 999px; font-weight: 600; flex-shrink: 0; }
    .konsultasi-banner { background: linear-gradient(135deg, var(--ac-green-dark) 0%, var(--ac-green) 100%); border-radius: 16px; padding: 1.5rem; color: white; position: relative; overflow: hidden; }
    .konsultasi-banner::after { content: ''; position: absolute; width: 150px; height: 150px; background: rgba(255,255,255,0.07); border-radius: 50%; right: -40px; top: -40px; }
    .btn-banner { background: #fff; color: var(--ac-green-dark); border: none; border-radius: 8px; font-size: 0.825rem; font-weight: 700; padding: 0.5rem 1.25rem; text-decoration: none; display: inline-block; margin-top: 0.75rem; transition: all 0.2s; }
    .btn-banner:hover { background: var(--ac-green-light); color: var(--ac-green-dark); }
    .chart-wrapper { position: relative; height: 180px; }
    .tip-item { display: flex; gap: 10px; padding: 0.75rem 0; border-bottom: 1px solid var(--ac-border); align-items: flex-start; }
    .tip-item:last-child { border-bottom: none; }
    .tip-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
    .tip-text { font-size: 0.825rem; color: var(--ac-text); line-height: 1.5; }
    .tip-text strong { color: var(--ac-green-dark); font-weight: 600; }
    @media (max-width: 991px) { .ac-sidebar { display: none; } .ac-main { margin-left: 0; padding: 1.25rem; } }
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
                    <div style="font-size:.75rem;color:var(--ac-muted)">{{ Str::limit(auth()->user()->email, 22) }}</div>
                </div>
            </div>
        </div>
        <div class="sidebar-section">
            <div class="sidebar-label">Menu Utama</div>
            <a href="{{ url('/dashboard') }}" class="sidebar-link active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a>
            <a href="{{ url('/jurnal') }}" class="sidebar-link"><i class="bi bi-journal-heart"></i> Jurnal Kulit</a>
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
                <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start" style="cursor:pointer;color:var(--ac-muted)">
                    <i class="bi bi-box-arrow-left"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="ac-main flex-grow-1">
        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <div>
                <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">
                    Halo, {{ auth()->user()->name }}! 👋
                </h1>
                <p style="font-size:0.875rem;color:var(--ac-muted);margin:4px 0 0">
                    <i class="bi bi-calendar3 me-1"></i>{{ now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <a href="{{ url('/jurnal/buat') }}" class="btn btn-ac-primary">
                <i class="bi bi-plus-lg me-1"></i> Tambah Jurnal Hari Ini
            </a>
        </div>

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#E1F5EE"><i class="bi bi-journal-check" style="color:var(--ac-green)"></i></div>
                    <div class="stat-number">{{ $totalJurnal }}</div>
                    <div class="stat-label">Total Jurnal</div>
                    <div class="stat-change" style="color:var(--ac-green)"><i class="bi bi-journal-text"></i> Semua catatan</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#EEEDFE"><i class="bi bi-clipboard2-check" style="color:#534AB7"></i></div>
                    <div class="stat-number">{{ $totalKonsultasi }}</div>
                    <div class="stat-label">Konsultasi</div>
                    <div class="stat-change" style="color:#534AB7">
                        <i class="bi bi-patch-check"></i>
                        {{ $konsultasiTerakhir ? 'Terakhir: '.$konsultasiTerakhir->hasil_label : 'Belum ada' }}
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#E6F1FB"><i class="bi bi-bag-check" style="color:#185FA5"></i></div>
                    <div class="stat-number">{{ $totalProduk }}</div>
                    <div class="stat-label">Produk Aktif</div>
                    <div class="stat-change" style="color:#185FA5"><i class="bi bi-bag-heart"></i> Sedang dipakai</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#FAEEDA"><i class="bi bi-graph-up-arrow" style="color:#BA7517"></i></div>
                    <div class="stat-number">{{ $rataRating }}/5</div>
                    <div class="stat-label">Rata-rata Minggu Ini</div>
                    <div class="stat-change" style="color:#BA7517"><i class="bi bi-calendar-week"></i> 7 hari terakhir</div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-lg-8">
                <div class="ac-card">
                    <div class="ac-card-title">
                        <span><i class="bi bi-graph-up me-2 text-ac"></i>Grafik Kondisi Kulit — 7 Hari Terakhir</span>
                        <a href="{{ url('/jurnal') }}">Lihat semua</a>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="skinChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="konsultasi-banner mb-3">
                    <div style="font-size:0.7rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;opacity:.75;margin-bottom:.5rem">Fitur Unggulan</div>
                    <div style="font-size:1.1rem;font-weight:700;line-height:1.3">Belum Tahu Jenis<br>Jerawatmu? 🔍</div>
                    <div style="font-size:0.8rem;opacity:.8;margin-top:.5rem;line-height:1.6">Jawab beberapa pertanyaan singkat dan sistem kami identifikasi jenis jerawatmu secara otomatis.</div>
                    <a href="{{ url('/konsultasi') }}" class="btn-banner"><i class="bi bi-arrow-right-circle me-1"></i> Mulai Konsultasi</a>
                </div>
                <div class="ac-card" style="padding:1rem">
                    <div class="ac-card-title" style="margin-bottom:.75rem">
                        <span><i class="bi bi-lightbulb me-2 text-ac"></i>Tips Hari Ini</span>
                    </div>
                    <div class="tip-item">
                        <div class="tip-icon" style="background:#E1F5EE"><i class="bi bi-droplet-half" style="color:var(--ac-green)"></i></div>
                        <div class="tip-text"><strong>Minum 8 gelas air</strong> sehari membantu detoks dan memperbaiki kondisi kulit.</div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-icon" style="background:#E6F1FB"><i class="bi bi-sun" style="color:#185FA5"></i></div>
                        <div class="tip-text"><strong>Pakai sunscreen</strong> setiap pagi meski cuaca mendung untuk lindungi kulit.</div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-icon" style="background:#FAEEDA"><i class="bi bi-moon-stars" style="color:#BA7517"></i></div>
                        <div class="tip-text"><strong>Tidur 7–8 jam</strong> cukup membantu regenerasi sel kulit secara optimal.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-6">
                <div class="ac-card">
                    <div class="ac-card-title">
                        <span><i class="bi bi-journal-heart me-2 text-ac"></i>Jurnal Terbaru</span>
                        <a href="{{ url('/jurnal') }}">Lihat semua</a>
                    </div>
                    @forelse($jurnalTerbaru as $j)
                    <div class="journal-item">
                        <div class="journal-date">
                            <div class="journal-day">{{ $j->tanggal->format('d') }}</div>
                            <div class="journal-month">{{ $j->tanggal->format('M') }}</div>
                        </div>
                        <div>
                            <div class="journal-title">{{ ucfirst($j->kondisi) }} — Rating {{ $j->rating }}/5</div>
                            <div class="journal-note">{{ Str::limit($j->catatan ?? 'Tidak ada catatan', 60) }}</div>
                            <div class="rating-bar">
                                @for($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $j->rating ? 'filled' : '' }}"></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align:center;padding:2rem;color:var(--ac-muted);font-size:.875rem">
                        <i class="bi bi-journal-x" style="font-size:2rem;display:block;margin-bottom:.5rem"></i>
                        Belum ada jurnal. Mulai catat hari ini!
                    </div>
                    @endforelse
                    <a href="{{ url('/jurnal/buat') }}" class="btn btn-ac-outline w-100 mt-3" style="font-size:0.85rem">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Jurnal Baru
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ac-card">
                    <div class="ac-card-title">
                        <span><i class="bi bi-bag-heart me-2 text-ac"></i>Produk Aktif Dipakai</span>
                        <a href="{{ url('/produk') }}">Lihat semua</a>
                    </div>
                    @forelse($produkAktif as $t)
                    <div class="product-item">
                        <div class="product-icon"><i class="bi bi-droplet-fill"></i></div>
                        <div>
                            <div class="product-name">{{ $t->nama_produk }}</div>
                            <div class="product-type">{{ $t->waktu_label }} · {{ $t->frekuensi ?? 'Setiap hari' }}</div>
                        </div>
                        <span class="product-badge" style="background:#E1F5EE;color:#085041">Aktif</span>
                    </div>
                    @empty
                    <div style="text-align:center;padding:2rem;color:var(--ac-muted);font-size:.875rem">
                        <i class="bi bi-bag-x" style="font-size:2rem;display:block;margin-bottom:.5rem"></i>
                        Belum ada produk aktif.
                    </div>
                    @endforelse
                    <a href="{{ url('/produk/tambah') }}" class="btn btn-ac-outline w-100 mt-3" style="font-size:0.85rem">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Produk Baru
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const ctx = document.getElementById('skinChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Rating Kondisi Kulit',
            data: {!! json_encode($grafik) !!},
            borderColor: '#1D9E75',
            backgroundColor: 'rgba(29,158,117,0.08)',
            borderWidth: 2.5,
            pointBackgroundColor: '#1D9E75',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5,
            tension: 0.4,
            fill: true,
            spanGaps: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#085041',
                callbacks: {
                    label: ctx => ctx.raw ? ` Rating: ${ctx.raw}/5` : ' Tidak ada data'
                }
            }
        },
        scales: {
            y: {
                min: 0, max: 5,
                ticks: { stepSize: 1, color: '#6B7280' },
                grid: { color: '#F3F4F6' }
            },
            x: {
                ticks: { color: '#6B7280' },
                grid: { display: false }
            }
        }
    }
});
</script>
@endpush