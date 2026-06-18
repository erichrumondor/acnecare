@extends('layouts.app')
@section('title', 'Profil Saya')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .profile-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; margin-bottom:1.25rem; }
    .avatar-wrap { position:relative; width:88px; height:88px; margin:0 auto 1rem; }
    .avatar-img { width:88px; height:88px; border-radius:50%; object-fit:cover; border:3px solid var(--ac-green-light); }
    .avatar-placeholder { width:88px; height:88px; border-radius:50%; background:var(--ac-green); display:flex; align-items:center; justify-content:center; font-size:2rem; font-weight:700; color:#fff; border:3px solid var(--ac-green-light); }
    .avatar-edit { position:absolute; bottom:0; right:0; width:28px; height:28px; background:var(--ac-green); border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; border:2px solid #fff; }
    .form-label { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); margin-bottom:.4rem; }
    .form-control, .form-select { border:1px solid var(--ac-border); border-radius:10px; font-size:.875rem; padding:.65rem 1rem; transition:border-color .2s; }
    .form-control:focus, .form-select:focus { border-color:var(--ac-green); box-shadow:0 0 0 3px rgba(29,158,117,.1); outline:none; }
    .tab-nav { display:flex; gap:4px; background:var(--ac-green-light); border-radius:12px; padding:4px; margin-bottom:1.5rem; }
    .tab-btn { flex:1; text-align:center; padding:.5rem; border-radius:10px; font-size:.875rem; font-weight:600; cursor:pointer; border:none; background:transparent; color:var(--ac-muted); transition:all .15s; }
    .tab-btn.active { background:#fff; color:var(--ac-green-dark); box-shadow:0 1px 4px rgba(0,0,0,.08); }
    .tab-content { display:none; }
    .tab-content.active { display:block; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <h1 style="font-size:1.5rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1.5rem">
        <i class="bi bi-person-circle me-2"></i>Profil Saya
    </h1>

    @if(session('sukses'))
    <div class="alert d-flex align-items-center gap-2 mb-4" style="border-radius:12px;border:none;background:#E1F5EE;color:#085041">
        <i class="bi bi-check-circle-fill"></i>{{ session('sukses') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert mb-4" style="border-radius:12px;border:none;background:#FAECE7;color:#993C1D">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
    </div>
    @endif

    {{-- Avatar --}}
    <div class="profile-card text-center">
        <div class="avatar-wrap">
            @if($user->foto)
                <img src="{{ Storage::url($user->foto) }}" alt="Foto profil" class="avatar-img">
            @else
                <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            @endif
            <label for="fotoInput" class="avatar-edit">
                <i class="bi bi-camera-fill" style="font-size:.7rem;color:#fff"></i>
            </label>
        </div>
        <div style="font-size:1.1rem;font-weight:700;color:var(--ac-green-dark)">{{ $user->name }}</div>
        <div style="font-size:.875rem;color:var(--ac-muted)">{{ $user->email }}</div>
        <div style="font-size:.775rem;color:var(--ac-muted);margin-top:.35rem">
            Bergabung sejak {{ $user->created_at->format('d M Y') }}
        </div>
    </div>

    {{-- Tab --}}
    <div class="profile-card">
        <div class="tab-nav">
            <button class="tab-btn active" onclick="switchTab('info')">Info Pribadi</button>
            <button class="tab-btn" onclick="switchTab('kulit')">Profil Kulit</button>
            <button class="tab-btn" onclick="switchTab('password')">Password</button>
        </div>

        {{-- Tab Info Pribadi --}}
        <div class="tab-content active" id="tab-info">
            <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none" onchange="this.form.submit()">

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-person me-1"></i>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-envelope me-1"></i>Alamat Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <button type="submit" class="btn btn-ac-primary w-100 py-2">
                    <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- Tab Profil Kulit --}}
        <div class="tab-content" id="tab-kulit">
            <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="email" value="{{ $user->email }}">

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-droplet me-1"></i>Tipe Kulit</label>
                    <select name="tipe_kulit" class="form-select">
                        <option value="">-- Pilih tipe kulit --</option>
                        <option value="normal" {{ $user->tipe_kulit == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="berminyak" {{ $user->tipe_kulit == 'berminyak' ? 'selected' : '' }}>Berminyak</option>
                        <option value="kering" {{ $user->tipe_kulit == 'kering' ? 'selected' : '' }}>Kering</option>
                        <option value="kombinasi" {{ $user->tipe_kulit == 'kombinasi' ? 'selected' : '' }}>Kombinasi</option>
                        <option value="sensitif" {{ $user->tipe_kulit == 'sensitif' ? 'selected' : '' }}>Sensitif</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-shield-exclamation me-1"></i>Alergi yang Diketahui</label>
                    <textarea name="alergi" class="form-control" rows="3"
                        placeholder="Contoh: fragrance, alkohol, niacinamide...">{{ old('alergi', $user->alergi) }}</textarea>
                    <div style="font-size:.75rem;color:var(--ac-muted);margin-top:4px">
                        Pisahkan dengan koma jika lebih dari satu
                    </div>
                </div>
                <button type="submit" class="btn btn-ac-primary w-100 py-2">
                    <i class="bi bi-check-lg me-1"></i>Simpan Profil Kulit
                </button>
            </form>
        </div>

        {{-- Tab Password --}}
        <div class="tab-content" id="tab-password">
            <form method="POST" action="{{ route('profil.password') }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-lock me-1"></i>Password Lama</label>
                    <input type="password" name="password_lama" class="form-control" required placeholder="••••••••">
                    @error('password_lama')
                        <div style="font-size:.8rem;color:#D85A30;margin-top:4px">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-lock-fill me-1"></i>Password Baru</label>
                    <input type="password" name="password" class="form-control" required placeholder="Min. 8 karakter">
                </div>
                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-lock-fill me-1"></i>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi password baru">
                </div>
                <button type="submit" class="btn btn-ac-primary w-100 py-2">
                    <i class="bi bi-shield-check me-1"></i>Ganti Password
                </button>
            </form>
        </div>
        {{-- Tombol Keluar --}}
        <div class="profile-card" style="border-color:#FECACA">
             <div style="font-size:.9rem;font-weight:700;color:#991B1B;margin-bottom:.5rem">
               <i class="bi bi-box-arrow-left me-2"></i>Keluar dari Akun
             </div>
                      <p style="font-size:.825rem;color:var(--ac-muted);margin-bottom:1rem">
        Kamu akan keluar dari sesi AcneCare saat ini.
              </p>
                 <form method="POST" action="{{ route('logout') }}">
                   @csrf
               <button type="submit" class="btn w-100 py-2" style="background:#FEF2F2;color:#991B1B;border:1px solid #FECACA;border-radius:10px;font-weight:600;font-size:.875rem">
            <i class="bi bi-box-arrow-left me-2"></i>Keluar dari AcneCare
        </button>
    </form>
</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    event.target.classList.add('active');
}
</script>
@endpush