<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — AcneCare Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ac-green: #1D9E75; --ac-green-dark: #085041;
            --ac-green-light: #E1F5EE; --ac-green-mid: #9FE1CB;
            --ac-muted: #6B7280; --ac-border: #E5E7EB;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F8FDFB; }
        .admin-sidebar {
            width: 240px; min-height: 100vh; background: var(--ac-green-dark);
            padding: 1.5rem 0; position: fixed; top: 0; left: 0; z-index: 100;
        }
        .admin-brand { padding: 0 1.25rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.1); margin-bottom: 1rem; }
        .admin-brand-name { font-size: 1.1rem; font-weight: 700; color: #fff; }
        .admin-brand-sub { font-size: .7rem; color: rgba(255,255,255,.5); }
        .admin-nav-label { font-size: .65rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: rgba(255,255,255,.4); padding: 0 1.25rem; margin: 1rem 0 .35rem; }
        .admin-nav-link { display: flex; align-items: center; gap: 10px; padding: .6rem 1.25rem; font-size: .875rem; font-weight: 500; color: rgba(255,255,255,.65); text-decoration: none; transition: all .15s; margin-bottom: 2px; }
        .admin-nav-link:hover { background: rgba(255,255,255,.08); color: #fff; }
        .admin-nav-link.active { background: rgba(255,255,255,.12); color: #fff; border-left: 3px solid var(--ac-green-mid); }
        .admin-nav-link i { font-size: 1rem; width: 20px; text-align: center; }
        .admin-main { margin-left: 240px; padding: 2rem; min-height: 100vh; }
        .admin-topbar { background: #fff; border-bottom: 1px solid var(--ac-border); padding: .875rem 2rem; margin: -2rem -2rem 2rem; display: flex; align-items: center; justify-content: space-between; }
        .btn-ac-primary { background: var(--ac-green); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: .875rem; padding: .5rem 1.25rem; transition: background .2s; }
        .btn-ac-primary:hover { background: var(--ac-green-dark); color: #fff; }
        .btn-ac-outline { background: transparent; color: var(--ac-green); border: 1.5px solid var(--ac-green); border-radius: 8px; font-weight: 600; font-size: .875rem; padding: .5rem 1.25rem; transition: all .2s; }
        .btn-ac-outline:hover { background: var(--ac-green-light); color: var(--ac-green-dark); }
        .form-control, .form-select { border: 1px solid var(--ac-border); border-radius: 10px; font-size: .875rem; padding: .65rem 1rem; transition: border-color .2s; }
        .form-control:focus, .form-select:focus { border-color: var(--ac-green); box-shadow: 0 0 0 3px rgba(29,158,117,.1); outline: none; }
        .form-label { font-size: .875rem; font-weight: 600; color: #374151; margin-bottom: .4rem; }
        .table { font-size: .875rem; }
        .table th { font-size: .775rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--ac-muted); border-bottom: 1px solid var(--ac-border); }
        .badge-published { background: #E1F5EE; color: #085041; font-size: .72rem; padding: 3px 10px; border-radius: 999px; font-weight: 600; }
        .badge-draft { background: #F1EFE8; color: #5F5E5A; font-size: .72rem; padding: 3px 10px; border-radius: 999px; font-weight: 600; }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-sidebar">
    <div class="admin-brand">
        <div class="admin-brand-name"><i class="bi bi-droplet-fill me-2" style="color:var(--ac-green-mid)"></i>AcneCare</div>
        <div class="admin-brand-sub">Panel Administrasi</div>
    </div>

    <div class="admin-nav-label">Menu Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>
    <a href="{{ route('admin.users') }}" class="admin-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Pengguna
    </a>

    <div class="admin-nav-label">Konten</div>
    <a href="{{ route('admin.artikel') }}" class="admin-nav-link {{ request()->routeIs('admin.artikel*') ? 'active' : '' }}">
        <i class="bi bi-newspaper"></i> Artikel
    </a>
    <a href="{{ route('admin.produk') }}" class="admin-nav-link {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
        <i class="bi bi-bag-heart"></i> Produk
    </a>

    <div class="admin-nav-label">Sistem</div>
    <a href="{{ url('/dashboard') }}" class="admin-nav-link">
        <i class="bi bi-arrow-left-circle"></i> Kembali ke App
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="admin-nav-link w-100 border-0 bg-transparent text-start" style="cursor:pointer">
            <i class="bi bi-box-arrow-left"></i> Keluar
        </button>
    </form>
</div>

<div class="admin-main">
    <div class="admin-topbar">
        <div style="font-size:.875rem;color:var(--ac-muted)">
            <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
            <span style="background:#E1F5EE;color:#085041;font-size:.7rem;padding:2px 8px;border-radius:999px;font-weight:600;margin-left:6px">Admin</span>
        </div>
        <div style="font-size:.8rem;color:var(--ac-muted)">
            <i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}
        </div>
    </div>

    @if(session('sukses'))
    <div class="alert d-flex align-items-center gap-2 mb-4" style="border-radius:12px;border:none;background:#E1F5EE;color:#085041;font-size:.875rem">
        <i class="bi bi-check-circle-fill"></i>{{ session('sukses') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>