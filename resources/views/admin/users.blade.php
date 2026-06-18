<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna — AcneCare Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--ac-green:#1D9E75;--ac-green-dark:#085041;--ac-green-light:#E1F5EE;--ac-muted:#6B7280;--ac-border:#E5E7EB}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#F8FDFB;margin:0}
        .admin-sidebar{width:230px;min-height:100vh;background:var(--ac-green-dark);padding:1.5rem 0;position:fixed;top:0;left:0;z-index:100}
        .admin-brand{padding:.75rem 1.25rem 1.25rem;border-bottom:1px solid rgba(255,255,255,.1);margin-bottom:1rem}
        .admin-brand-name{font-size:1.1rem;font-weight:700;color:#fff}
        .admin-brand-sub{font-size:.7rem;color:rgba(255,255,255,.5);margin-top:2px}
        .nav-label{font-size:.65rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.4);padding:0 1.25rem;margin:.75rem 0 .25rem}
        .nav-link-admin{display:flex;align-items:center;gap:10px;padding:.6rem 1.25rem;font-size:.875rem;font-weight:500;color:rgba(255,255,255,.7);text-decoration:none;transition:all .15s;margin-bottom:1px}
        .nav-link-admin:hover,.nav-link-admin.active{background:rgba(255,255,255,.1);color:#fff}
        .nav-link-admin i{font-size:1rem;width:18px;text-align:center}
        .admin-main{margin-left:230px;padding:2rem}
        .topbar{background:#fff;border-bottom:1px solid var(--ac-border);padding:.875rem 2rem;margin:-2rem -2rem 2rem;display:flex;align-items:center;justify-content:space-between}
        .ac-card{background:#fff;border:1px solid var(--ac-border);border-radius:14px;padding:1.25rem}
        .table{font-size:.875rem}
        .table th{font-size:.775rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--ac-muted);border-bottom:2px solid var(--ac-border)}
        .avatar-sm{width:34px;height:34px;border-radius:50%;background:var(--ac-green);display:flex;align-items:center;justify-content:center;color:white;font-size:.85rem;font-weight:700;flex-shrink:0}
    </style>
</head>
<body>
<div class="admin-sidebar">
    <div class="admin-brand">
        <div class="admin-brand-name">● AcneCare</div>
        <div class="admin-brand-sub">Panel Administrasi</div>
    </div>
    <div class="nav-label">Menu</div>
    <a href="{{ url('/admin/dashboard') }}" class="nav-link-admin"><i class="bi bi-grid-fill"></i> Dashboard</a>
    <a href="{{ url('/admin/users') }}" class="nav-link-admin active"><i class="bi bi-people-fill"></i> Pengguna</a>
    <div class="nav-label">Konten</div>
    <a href="{{ url('/admin/artikel') }}" class="nav-link-admin"><i class="bi bi-newspaper"></i> Artikel</a>
    <a href="{{ url('/admin/produk') }}" class="nav-link-admin"><i class="bi bi-bag-heart"></i> Produk</a>
    <div class="nav-label">Lainnya</div>
    <a href="{{ url('/dashboard') }}" class="nav-link-admin"><i class="bi bi-arrow-left-circle"></i> Kembali ke App</a>
    <form method="POST" action="{{ route('logout') }}">@csrf
        <button type="submit" class="nav-link-admin w-100 border-0 bg-transparent text-start" style="cursor:pointer"><i class="bi bi-box-arrow-left"></i> Keluar</button>
    </form>
</div>

<div class="admin-main">
    <div class="topbar">
        <div style="font-size:.875rem;color:var(--ac-muted)"><i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
            <span style="background:#E1F5EE;color:#085041;font-size:.7rem;padding:2px 8px;border-radius:999px;font-weight:600;margin-left:6px">Admin</span>
        </div>
        <div style="font-size:.8rem;color:var(--ac-muted)"><i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}</div>
    </div>

    <div class="mb-4">
        <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">Kelola Pengguna</h1>
        <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">Total {{ $users->total() }} pengguna terdaftar</p>
    </div>

    @if(session('sukses'))
    <div class="alert d-flex align-items-center gap-2 mb-3" style="border-radius:12px;border:none;background:#E1F5EE;color:#085041;font-size:.875rem">
        <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="ac-card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr>
                    <th>#</th>
                    <th>Pengguna</th>
                    <th>Email</th>
                    <th>Tipe Kulit</th>
                    <th>Status</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr></thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td style="color:var(--ac-muted)">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar-sm">{{ strtoupper(substr($user->name,0,1)) }}</div>
                                <div style="font-weight:500">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td style="color:var(--ac-muted)">{{ $user->email }}</td>
                        <td>
                            @if($user->tipe_kulit)
                            <span style="font-size:.75rem;padding:3px 10px;border-radius:999px;background:var(--ac-green-light);color:var(--ac-green-dark);font-weight:600">{{ ucfirst($user->tipe_kulit) }}</span>
                            @else
                            <span style="color:var(--ac-muted);font-size:.825rem">—</span>
                            @endif
                        </td>
                        <td>
                            <span style="font-size:.75rem;padding:3px 10px;border-radius:999px;font-weight:600;background:{{ $user->email_verified_at ? '#E1F5EE' : '#FAEEDA' }};color:{{ $user->email_verified_at ? '#085041' : '#633806' }}">
                                {{ $user->email_verified_at ? '✓ Aktif' : '⏳ Belum Verifikasi' }}
                            </span>
                        </td>
                        <td style="color:var(--ac-muted)">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form method="POST" action="{{ url('/admin/users/'.$user->id.'/toggle') }}">
                                @csrf @method('PUT')
                                <button type="submit" class="btn btn-sm"
                                    style="font-size:.775rem;border-radius:8px;background:{{ $user->email_verified_at ? '#FAECE7' : '#E1F5EE' }};color:{{ $user->email_verified_at ? '#D85A30' : '#085041' }};border:none">
                                    {{ $user->email_verified_at ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;padding:3rem;color:var(--ac-muted)">Belum ada pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $users->links() }}</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>