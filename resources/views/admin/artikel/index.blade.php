<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Artikel — AcneCare Admin</title>
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
        .btn-ac{background:var(--ac-green);color:#fff;border:none;border-radius:8px;font-weight:600;font-size:.875rem;padding:.5rem 1.25rem;text-decoration:none;display:inline-block}
        .btn-ac:hover{background:var(--ac-green-dark);color:#fff}
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
    <a href="{{ url('/admin/users') }}" class="nav-link-admin"><i class="bi bi-people-fill"></i> Pengguna</a>
    <div class="nav-label">Konten</div>
    <a href="{{ url('/admin/artikel') }}" class="nav-link-admin active"><i class="bi bi-newspaper"></i> Artikel</a>
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

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin:0">Kelola Artikel</h1>
            <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">Total {{ $artikel->total() }} artikel</p>
        </div>
        <a href="{{ url('/admin/artikel/buat') }}" class="btn-ac"><i class="bi bi-plus-lg me-1"></i> Tambah Artikel</a>
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
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr></thead>
                <tbody>
                    @forelse($artikel as $item)
                    <tr>
                        <td style="color:var(--ac-muted)">{{ $loop->iteration }}</td>
                        <td style="font-weight:500">{{ Str::limit($item->judul, 50) }}</td>
                        <td>
                            <span style="font-size:.75rem;padding:3px 10px;border-radius:999px;background:var(--ac-green-light);color:var(--ac-green-dark);font-weight:600">
                                {{ ucfirst($item->kategori) }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size:.75rem;padding:3px 10px;border-radius:999px;font-weight:600;background:{{ ($item->is_published ?? $item->published ?? false) ? '#E1F5EE' : '#FAEEDA' }};color:{{ ($item->is_published ?? $item->published ?? false) ? '#085041' : '#633806' }}">
                                {{ ($item->is_published ?? $item->published ?? false) ? '✓ Tayang' : '⏳ Draft' }}
                            </span>
                        </td>
                        <td style="color:var(--ac-muted)">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ url('/admin/artikel/'.$item->id.'/edit') }}" class="btn btn-sm" style="background:#E6F1FB;color:#185FA5;border-radius:8px;font-size:.775rem"><i class="bi bi-pencil"></i> Edit</a>
                                <form method="POST" action="{{ url('/admin/artikel/'.$item->id) }}" onsubmit="return confirm('Hapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background:#FAECE7;color:#D85A30;border-radius:8px;font-size:.775rem"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center;padding:3rem;color:var(--ac-muted)">
                        Belum ada artikel. <a href="{{ url('/admin/artikel/buat') }}" style="color:var(--ac-green)">Tambah sekarang →</a>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $artikel->links() }}</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>