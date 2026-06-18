<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — AcneCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ac-green:#1D9E75; --ac-green-dark:#085041; --ac-green-light:#E1F5EE; --ac-muted:#6B7280; --ac-border:#E5E7EB; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:#F8FDFB; margin:0; }
        .admin-sidebar { width:230px; min-height:100vh; background:var(--ac-green-dark); padding:1.5rem 0; position:fixed; top:0; left:0; z-index:100; }
        .admin-brand { padding:.75rem 1.25rem 1.25rem; border-bottom:1px solid rgba(255,255,255,.1); margin-bottom:1rem; }
        .admin-brand-name { font-size:1.1rem; font-weight:700; color:#fff; }
        .admin-brand-sub { font-size:.7rem; color:rgba(255,255,255,.5); margin-top:2px; }
        .nav-label { font-size:.65rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:rgba(255,255,255,.4); padding:0 1.25rem; margin:.75rem 0 .25rem; }
        .nav-link-admin { display:flex; align-items:center; gap:10px; padding:.6rem 1.25rem; font-size:.875rem; font-weight:500; color:rgba(255,255,255,.7); text-decoration:none; transition:all .15s; margin-bottom:1px; }
        .nav-link-admin:hover, .nav-link-admin.active { background:rgba(255,255,255,.1); color:#fff; }
        .nav-link-admin i { font-size:1rem; width:18px; text-align:center; }
        .admin-main { margin-left:230px; padding:2rem; }
        .topbar { background:#fff; border-bottom:1px solid var(--ac-border); padding:.875rem 2rem; margin:-2rem -2rem 2rem; display:flex; align-items:center; justify-content:space-between; }
        .stat-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1.25rem; }
        .stat-icon { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; margin-bottom:.875rem; }
        .stat-num { font-size:2rem; font-weight:700; color:var(--ac-green-dark); line-height:1; }
        .stat-lbl { font-size:.8rem; color:var(--ac-muted); margin-top:4px; }
        .ac-card { background:#fff; border:1px solid var(--ac-border); border-radius:14px; padding:1.25rem; }
        .ac-card-title { font-size:.95rem; font-weight:700; color:var(--ac-green-dark); margin-bottom:1rem; display:flex; align-items:center; justify-content:space-between; }
        .table { font-size:.875rem; }
        .table th { font-size:.775rem; font-weight:700; text-transform:uppercase; letter-spacing:.05em; color:var(--ac-muted); }
        .btn-ac { background:var(--ac-green); color:#fff; border:none; border-radius:8px; font-weight:600; font-size:.875rem; padding:.5rem 1.25rem; text-decoration:none; display:inline-block; }
        .btn-ac:hover { background:var(--ac-green-dark); color:#fff; }
    </style>
</head>
<body>

{{-- SIDEBAR --}}
<div class="admin-sidebar">
    <div class="admin-brand">
        <div class="admin-brand-name">● AcneCare</div>
        <div class="admin-brand-sub">Panel Administrasi</div>
    </div>
    <div class="nav-label">Menu</div>
    <a href="{{ url('/admin/dashboard') }}" class="nav-link-admin active"><i class="bi bi-grid-fill"></i> Dashboard</a>
    <a href="{{ url('/admin/users') }}" class="nav-link-admin"><i class="bi bi-people-fill"></i> Pengguna</a>
    <div class="nav-label">Konten</div>
    <a href="{{ url('/admin/artikel') }}" class="nav-link-admin"><i class="bi bi-newspaper"></i> Artikel</a>
    <a href="{{ url('/admin/produk') }}" class="nav-link-admin"><i class="bi bi-bag-heart"></i> Produk</a>
    <div class="nav-label">Lainnya</div>
    <a href="{{ url('/dashboard') }}" class="nav-link-admin"><i class="bi bi-arrow-left-circle"></i> Kembali ke App</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-link-admin w-100 border-0 bg-transparent text-start" style="cursor:pointer">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </button>
    </form>
</div>

{{-- MAIN --}}
<div class="admin-main">
    <div class="topbar">
        <div style="font-size:.875rem;color:var(--ac-muted)">
            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
            <span style="background:#E1F5EE;color:#085041;font-size:.7rem;padding:2px 8px;border-radius:999px;font-weight:600;margin-left:6px">Admin</span>
        </div>
        <div style="font-size:.8rem;color:var(--ac-muted)">
            <i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}
        </div>
    </div>

    <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.25rem">Dashboard Admin</h1>
    <p style="font-size:.875rem;color:var(--ac-muted);margin-bottom:1.5rem">Selamat datang, {{ auth()->user()->name }}!</p>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background:#E1F5EE"><i class="bi bi-people-fill" style="color:var(--ac-green)"></i></div>
                <div class="stat-num">{{ $totalUser }}</div>
                <div class="stat-lbl">Total Pengguna</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background:#E6F1FB"><i class="bi bi-newspaper" style="color:#185FA5"></i></div>
                <div class="stat-num">{{ $totalArtikel }}</div>
                <div class="stat-lbl">Total Artikel</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon" style="background:#EEEDFE"><i class="bi bi-journal-heart" style="color:#534AB7"></i></div>
                <div class="stat-num">{{ $totalJurnal }}</div>
                <div class="stat-lbl">Total Jurnal Kulit</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- User Terbaru --}}
        <div class="col-lg-6">
            <div class="ac-card">
                <div class="ac-card-title">
                    <span><i class="bi bi-people me-2" style="color:var(--ac-green)"></i>Pengguna Terbaru</span>
                    <a href="{{ url('/admin/users') }}" style="font-size:.8rem;color:var(--ac-green);text-decoration:none">Lihat semua</a>
                </div>
                <table class="table table-borderless mb-0">
                    <thead><tr>
                        <th>Nama</th><th>Email</th><th>Bergabung</th>
                    </tr></thead>
                    <tbody>
                        @forelse($userTerbaru as $u)
                        <tr style="border-bottom:1px solid var(--ac-border)">
                            <td style="font-weight:500">{{ $u->name }}</td>
                            <td style="color:var(--ac-muted)">{{ Str::limit($u->email,20) }}</td>
                            <td style="color:var(--ac-muted)">{{ $u->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="text-align:center;color:var(--ac-muted);padding:1.5rem">Belum ada pengguna</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Artikel Terbaru --}}
        <div class="col-lg-6">
            <div class="ac-card">
                <div class="ac-card-title">
                    <span><i class="bi bi-newspaper me-2" style="color:var(--ac-green)"></i>Artikel Terbaru</span>
                    <a href="{{ url('/admin/artikel') }}" style="font-size:.8rem;color:var(--ac-green);text-decoration:none">Lihat semua</a>
                </div>
                @forelse($artikelTerbaru as $item)
                <div style="display:flex;align-items:center;justify-content:space-between;padding:.7rem 0;border-bottom:1px solid var(--ac-border);font-size:.875rem">
                    <div style="font-weight:500;color:#1A1A1A">{{ Str::limit($item->judul, 35) }}</div>
                    <span style="font-size:.7rem;padding:3px 10px;border-radius:999px;font-weight:600;flex-shrink:0;margin-left:8px;background:{{ $item->is_published ?? $item->published ?? false ? '#E1F5EE' : '#F1EFE8' }};color:{{ $item->is_published ?? $item->published ?? false ? '#085041' : '#5F5E5A' }}">
                        {{ ($item->is_published ?? $item->published ?? false) ? 'Tayang' : 'Draft' }}
                    </span>
                </div>
                @empty
                <p style="text-align:center;color:var(--ac-muted);padding:1.5rem 0">Belum ada artikel. <a href="{{ url('/admin/artikel/buat') }}" style="color:var(--ac-green)">Tambah sekarang →</a></p>
                @endforelse
                <div style="margin-top:1rem">
                    <a href="{{ url('/admin/artikel/buat') }}" class="btn-ac" style="font-size:.825rem"><i class="bi bi-plus-lg me-1"></i>Tambah Artikel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>