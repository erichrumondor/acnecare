<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — AcneCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--ac-green:#1D9E75;--ac-green-dark:#085041;--ac-green-light:#E1F5EE;--ac-green-mid:#9FE1CB;--ac-muted:#6B7280;--ac-border:#E5E7EB;}
        *{box-sizing:border-box;}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#F8FDFB;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem 1rem;}
        .auth-card{background:#fff;border:1px solid var(--ac-border);border-radius:20px;padding:2.5rem;width:100%;max-width:440px;box-shadow:0 8px 40px rgba(29,158,117,0.08);}
        .auth-logo{display:flex;align-items:center;gap:8px;font-size:1.25rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1.75rem;text-decoration:none;}
        .auth-logo .dot{width:10px;height:10px;background:var(--ac-green);border-radius:50%;}
        .auth-title{font-size:1.35rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.35rem;}
        .auth-sub{font-size:0.875rem;color:var(--ac-muted);margin-bottom:1.75rem;line-height:1.7;}
        .form-label{font-size:0.875rem;font-weight:600;color:#374151;margin-bottom:.4rem;}
        .form-control{border:1px solid var(--ac-border);border-radius:10px;padding:.65rem 1rem;font-size:0.9rem;transition:border-color .2s,box-shadow .2s;}
        .form-control:focus{border-color:var(--ac-green);box-shadow:0 0 0 3px rgba(29,158,117,0.12);outline:none;}
        .btn-ac{background:var(--ac-green);color:#fff;border:none;border-radius:10px;font-weight:600;font-size:0.95rem;padding:.7rem;width:100%;transition:background .2s,transform .15s;}
        .btn-ac:hover{background:var(--ac-green-dark);color:#fff;transform:translateY(-1px);}
        .alert-success{background:var(--ac-green-light);border:1px solid var(--ac-green-mid);border-radius:10px;color:var(--ac-green-dark);font-size:0.85rem;padding:.75rem 1rem;margin-bottom:1rem;}
        .alert-danger{background:#FEF2F2;border:1px solid #FECACA;border-radius:10px;color:#991B1B;font-size:0.85rem;padding:.75rem 1rem;margin-bottom:1rem;}
        a.ac-link{color:var(--ac-green);font-weight:600;text-decoration:none;}
        a.ac-link:hover{color:var(--ac-green-dark);text-decoration:underline;}
    </style>
</head>
<body>
<div class="auth-card">
    <a href="{{ url('/') }}" class="auth-logo"><span class="dot"></span> AcneCare</a>
    <div class="auth-title">Lupa password?</div>
    <div class="auth-sub">Masukkan alamat email kamu dan kami akan mengirimkan link untuk reset password.</div>

    @if (session('status'))
        <div class="alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-danger"><i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label" for="email">Alamat Email</label>
            <input id="email" type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
        </div>
        <button type="submit" class="btn btn-ac">
            <i class="bi bi-send me-2"></i>Kirim Link Reset Password
        </button>
    </form>

    <div class="text-center mt-4" style="font-size:.875rem;color:var(--ac-muted)">
        Ingat password kamu? <a href="{{ route('login') }}" class="ac-link">Kembali masuk</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>