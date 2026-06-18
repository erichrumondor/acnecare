<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — AcneCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ac-green: #1D9E75;
            --ac-green-dark: #085041;
            --ac-green-light: #E1F5EE;
            --ac-green-mid: #9FE1CB;
            --ac-muted: #6B7280;
            --ac-border: #E5E7EB;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F8FDFB;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: #fff;
            border: 1px solid var(--ac-border);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 8px 40px rgba(29,158,117,0.08);
        }
        .auth-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--ac-green-dark);
            margin-bottom: 1.75rem;
            text-decoration: none;
        }
        .auth-logo .dot {
            width: 10px; height: 10px;
            background: var(--ac-green);
            border-radius: 50%;
        }
        .auth-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--ac-green-dark);
            margin-bottom: .35rem;
        }
        .auth-sub {
            font-size: 0.875rem;
            color: var(--ac-muted);
            margin-bottom: 1.75rem;
        }
        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .4rem;
        }
        .form-control {
            border: 1px solid var(--ac-border);
            border-radius: 10px;
            padding: .65rem 1rem;
            font-size: 0.9rem;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--ac-green);
            box-shadow: 0 0 0 3px rgba(29,158,117,0.12);
            outline: none;
        }
        .btn-ac {
            background: var(--ac-green);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            padding: .7rem;
            width: 100%;
            transition: background .2s, transform .15s;
        }
        .btn-ac:hover {
            background: var(--ac-green-dark);
            color: #fff;
            transform: translateY(-1px);
        }
        .divider {
            text-align: center;
            font-size: 0.8rem;
            color: var(--ac-muted);
            margin: 1.25rem 0;
            position: relative;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: var(--ac-border);
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }
        .alert-danger {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 10px;
            color: #991B1B;
            font-size: 0.85rem;
            padding: .75rem 1rem;
            margin-bottom: 1rem;
        }
        .alert-success {
            background: var(--ac-green-light);
            border: 1px solid var(--ac-green-mid);
            border-radius: 10px;
            color: var(--ac-green-dark);
            font-size: 0.85rem;
            padding: .75rem 1rem;
            margin-bottom: 1rem;
        }
        .form-check-input:checked {
            background-color: var(--ac-green);
            border-color: var(--ac-green);
        }
        a.ac-link {
            color: var(--ac-green);
            font-weight: 600;
            text-decoration: none;
        }
        a.ac-link:hover { color: var(--ac-green-dark); text-decoration: underline; }
    </style>
</head>
<body>
<div class="auth-card">
   <a href="{{ url('/') }}" class="auth-logo">
    <span class="dot"></span> AcneCare
</a>

{{-- Tombol kembali --}}
<a href="{{ url('/') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:.825rem;color:var(--ac-muted);text-decoration:none;margin-bottom:1.5rem">
    <i class="bi bi-arrow-left"></i> Kembali ke Beranda
</a>

    <div class="auth-title">Selamat datang kembali!</div>
    <div class="auth-sub">Masuk untuk melanjutkan memantau kondisi kulitmu.</div>

    @if (session('status'))
        <div class="alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert-danger">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Alamat Email</label>
            <input id="email" type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required autofocus
                   placeholder="nama@email.com">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input id="password" type="password" name="password" class="form-control"
                   required placeholder="••••••••">
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" style="font-size:.85rem;color:var(--ac-muted)" for="remember">
                    Ingat saya
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="ac-link" style="font-size:.85rem">Lupa password?</a>
            @endif
        </div>
        <button type="submit" class="btn btn-ac">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
        </button>
    </form>

    <div class="divider">atau</div>

    <div class="text-center" style="font-size:.875rem;color:var(--ac-muted)">
        Belum punya akun?
        <a href="{{ route('register') }}" class="ac-link">Daftar gratis</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>