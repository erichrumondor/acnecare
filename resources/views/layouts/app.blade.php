<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AcneCare') — Kesehatan Kulit Jerawat</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --ac-green:       #1D9E75;
            --ac-green-dark:  #085041;
            --ac-green-light: #E1F5EE;
            --ac-green-mid:   #9FE1CB;
            --ac-text:        #1A1A1A;
            --ac-muted:       #6B7280;
            --ac-border:      #E5E7EB;
            --ac-bg:          #F8FDFB;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ac-text);
            background: #fff;
        }

        /* ── NAVBAR ── */
        .ac-navbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--ac-border);
            padding: 0.85rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .ac-navbar .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--ac-green-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .ac-navbar .navbar-brand .brand-dot {
            width: 10px; height: 10px;
            background: var(--ac-green);
            border-radius: 50%;
            display: inline-block;
        }
        .ac-navbar .nav-link {
            color: var(--ac-muted);
            font-size: 0.9rem;
            font-weight: 500;
            padding: 0.4rem 0.85rem !important;
            transition: color 0.2s;
        }
        .ac-navbar .nav-link:hover,
        .ac-navbar .nav-link.active { color: var(--ac-green); }
        .btn-ac-primary {
            background: var(--ac-green);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-ac-primary:hover {
            background: var(--ac-green-dark);
            color: #fff;
            transform: translateY(-1px);
        }
        .btn-ac-outline {
            background: transparent;
            color: var(--ac-green);
            border: 1.5px solid var(--ac-green);
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            transition: all 0.2s;
        }
        .btn-ac-outline:hover {
            background: var(--ac-green-light);
            color: var(--ac-green-dark);
        }

        /* ── FOOTER ── */
        .ac-footer {
            background: var(--ac-green-dark);
            color: rgba(255,255,255,0.7);
            padding: 2.5rem 0 1.5rem;
            font-size: 0.875rem;
        }
        .ac-footer a { color: rgba(255,255,255,0.6); text-decoration: none; }
        .ac-footer a:hover { color: #fff; }
        .ac-footer .footer-brand {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .ac-footer hr { border-color: rgba(255,255,255,0.15); }

        /* ── UTILS ── */
        .text-ac { color: var(--ac-green) !important; }
        .bg-ac-light { background: var(--ac-green-light); }
    </style>

    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="ac-navbar navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-dot"></span> AcneCare
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <i class="bi bi-list fs-4" style="color:var(--ac-green)"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/artikel') }}">Artikel</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/konsultasi') }}">Konsultasi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/forum') }}">Forum</a></li>
            </ul>
            <div class="ms-lg-3 d-flex gap-2 mt-2 mt-lg-0">
                @auth
    <a href="{{ url('/dashboard') }}" class="btn btn-ac-outline me-1">
        <i class="bi bi-grid me-1"></i> Dashboard
    </a>
    <a href="{{ url('/profil') }}" class="btn btn-ac-primary">
        <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
    </a>
@else
    <a href="{{ route('login') }}" class="btn btn-ac-outline">Masuk</a>
    <a href="{{ route('register') }}" class="btn btn-ac-primary">Daftar Gratis</a>
@endauth
            </div>
        </div>
    </div>
</nav>

{{-- KONTEN UTAMA --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="ac-footer">
    <div class="container">
        <div class="row g-4 mb-3">
            <div class="col-lg-4">
                <div class="footer-brand"><span style="color:var(--ac-green-mid)">●</span> AcneCare</div>
                <p class="mb-0" style="font-size:0.825rem;line-height:1.7">Platform kesehatan kulit khusus jerawat. Catat kondisi kulitmu, konsultasi jenis jerawat, dan temukan produk yang tepat.</p>
            </div>
            <div class="col-6 col-lg-2">
                <div class="fw-600 text-white mb-2" style="font-weight:600">Fitur</div>
                <ul class="list-unstyled mb-0" style="line-height:2">
                    <li><a href="#">Jurnal Kulit</a></li>
                    <li><a href="#">Konsultasi</a></li>
                    <li><a href="#">Produk</a></li>
                    <li><a href="#">Forum</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <div class="fw-600 text-white mb-2" style="font-weight:600">Info</div>
                <ul class="list-unstyled mb-0" style="line-height:2">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Artikel</a></li>
                    <li><a href="#">Privasi</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="text-center" style="font-size:0.8rem">
            © {{ date('Y') }} AcneCare — Dibuat untuk proyek kesehatan kulit
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>