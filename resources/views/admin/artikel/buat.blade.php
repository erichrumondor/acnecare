<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($artikel) ? 'Edit' : 'Tambah' }} Artikel — AcneCare Admin</title>
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
        .form-card{background:#fff;border:1px solid var(--ac-border);border-radius:16px;padding:1.75rem;max-width:780px}
        .form-label{font-size:.875rem;font-weight:600;color:#374151;margin-bottom:.4rem}
        .form-control,.form-select{border:1px solid var(--ac-border);border-radius:10px;font-size:.875rem;padding:.65rem 1rem;font-family:'Plus Jakarta Sans',sans-serif;transition:border-color .2s}
        .form-control:focus,.form-select:focus{border-color:var(--ac-green);box-shadow:0 0 0 3px rgba(29,158,117,.1);outline:none}
        .btn-ac{background:var(--ac-green);color:#fff;border:none;border-radius:8px;font-weight:600;font-size:.875rem;padding:.6rem 1.5rem;cursor:pointer;transition:background .2s}
        .btn-ac:hover{background:var(--ac-green-dark)}
        .btn-outline-ac{background:transparent;color:var(--ac-green);border:1.5px solid var(--ac-green);border-radius:8px;font-weight:600;font-size:.875rem;padding:.6rem 1.5rem;text-decoration:none;display:inline-block;transition:all .2s}
        .btn-outline-ac:hover{background:var(--ac-green-light);color:var(--ac-green-dark)}
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

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ url('/admin/artikel') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>

    @if($errors->any())
    <div class="alert mb-3" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="form-card">
        <h1 style="font-size:1.25rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1.5rem">
            <i class="bi bi-newspaper me-2" style="color:var(--ac-green)"></i>
            {{ isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel Baru' }}
        </h1>

        <form method="POST"
            action="{{ isset($artikel) ? url('/admin/artikel/'.$artikel->id) : url('/admin/artikel/simpan') }}"
            enctype="multipart/form-data">
            @csrf
            @if(isset($artikel)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Judul Artikel <span style="color:#D85A30">*</span></label>
                <input type="text" name="judul" class="form-control"
                    value="{{ old('judul', $artikel->judul ?? '') }}"
                    placeholder="Masukkan judul artikel..." required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kategori <span style="color:#D85A30">*</span></label>
                    <select name="kategori" class="form-select" required>
                        @foreach(['edukasi'=>'Edukasi','tips'=>'Tips Perawatan','mitos_fakta'=>'Mitos vs Fakta','produk'=>'Produk','lainnya'=>'Lainnya'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('kategori', $artikel->kategori ?? '') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Thumbnail <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                    @if(isset($artikel) && $artikel->thumbnail)
                        <img src="{{ Storage::url($artikel->thumbnail) }}" style="width:100%;height:70px;object-fit:cover;border-radius:8px;margin-bottom:.5rem">
                    @endif
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Ringkasan <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <textarea name="ringkasan" class="form-control" rows="2"
                    placeholder="Ringkasan singkat artikel..." maxlength="300">{{ old('ringkasan', $artikel->ringkasan ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Artikel <span style="color:#D85A30">*</span></label>
                <textarea name="konten" class="form-control" rows="12"
                    placeholder="Tulis isi artikel di sini..." required>{{ old('konten', $artikel->konten ?? $artikel->isi ?? '') }}</textarea>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="is_published" id="is_published" class="form-check-input"
                    {{ old('is_published', isset($artikel) && ($artikel->is_published ?? $artikel->published ?? false) ? 'on' : '') == 'on' ? 'checked' : '' }}>
                <label for="is_published" class="form-check-label" style="font-size:.875rem;font-weight:500">
                    Tayangkan artikel (tampil ke publik)
                </label>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn-ac">
                    <i class="bi bi-check-lg me-1"></i> {{ isset($artikel) ? 'Simpan Perubahan' : 'Tambah Artikel' }}
                </button>
                <a href="{{ url('/admin/artikel') }}" class="btn-outline-ac">Batal</a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($artikel) ? 'Edit' : 'Tambah' }} Artikel — AcneCare Admin</title>
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
        .form-card{background:#fff;border:1px solid var(--ac-border);border-radius:16px;padding:1.75rem;max-width:780px}
        .form-label{font-size:.875rem;font-weight:600;color:#374151;margin-bottom:.4rem}
        .form-control,.form-select{border:1px solid var(--ac-border);border-radius:10px;font-size:.875rem;padding:.65rem 1rem;font-family:'Plus Jakarta Sans',sans-serif;transition:border-color .2s}
        .form-control:focus,.form-select:focus{border-color:var(--ac-green);box-shadow:0 0 0 3px rgba(29,158,117,.1);outline:none}
        .btn-ac{background:var(--ac-green);color:#fff;border:none;border-radius:8px;font-weight:600;font-size:.875rem;padding:.6rem 1.5rem;cursor:pointer;transition:background .2s}
        .btn-ac:hover{background:var(--ac-green-dark)}
        .btn-outline-ac{background:transparent;color:var(--ac-green);border:1.5px solid var(--ac-green);border-radius:8px;font-weight:600;font-size:.875rem;padding:.6rem 1.5rem;text-decoration:none;display:inline-block;transition:all .2s}
        .btn-outline-ac:hover{background:var(--ac-green-light);color:var(--ac-green-dark)}
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

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ url('/admin/artikel') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>

    @if($errors->any())
    <div class="alert mb-3" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="form-card">
        <h1 style="font-size:1.25rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1.5rem">
            <i class="bi bi-newspaper me-2" style="color:var(--ac-green)"></i>
            {{ isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel Baru' }}
        </h1>

        <form method="POST"
            action="{{ isset($artikel) ? url('/admin/artikel/'.$artikel->id) : url('/admin/artikel/simpan') }}"
            enctype="multipart/form-data">
            @csrf
            @if(isset($artikel)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Judul Artikel <span style="color:#D85A30">*</span></label>
                <input type="text" name="judul" class="form-control"
                    value="{{ old('judul', $artikel->judul ?? '') }}"
                    placeholder="Masukkan judul artikel..." required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Kategori <span style="color:#D85A30">*</span></label>
                    <select name="kategori" class="form-select" required>
                        @foreach(['edukasi'=>'Edukasi','tips'=>'Tips Perawatan','mitos_fakta'=>'Mitos vs Fakta','produk'=>'Produk','lainnya'=>'Lainnya'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('kategori', $artikel->kategori ?? '') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Thumbnail <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                    @if(isset($artikel) && $artikel->thumbnail)
                        <img src="{{ Storage::url($artikel->thumbnail) }}" style="width:100%;height:70px;object-fit:cover;border-radius:8px;margin-bottom:.5rem">
                    @endif
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Ringkasan <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <textarea name="ringkasan" class="form-control" rows="2"
                    placeholder="Ringkasan singkat artikel..." maxlength="300">{{ old('ringkasan', $artikel->ringkasan ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Artikel <span style="color:#D85A30">*</span></label>
                <textarea name="konten" class="form-control" rows="12"
                    placeholder="Tulis isi artikel di sini..." required>{{ old('konten', $artikel->konten ?? $artikel->isi ?? '') }}</textarea>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="is_published" id="is_published" class="form-check-input"
                    {{ old('is_published', isset($artikel) && ($artikel->is_published ?? $artikel->published ?? false) ? 'on' : '') == 'on' ? 'checked' : '' }}>
                <label for="is_published" class="form-check-label" style="font-size:.875rem;font-weight:500">
                    Tayangkan artikel (tampil ke publik)
                </label>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn-ac">
                    <i class="bi bi-check-lg me-1"></i> {{ isset($artikel) ? 'Simpan Perubahan' : 'Tambah Artikel' }}
                </button>
                <a href="{{ url('/admin/artikel') }}" class="btn-outline-ac">Batal</a>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>