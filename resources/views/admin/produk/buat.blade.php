@extends('admin.layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 style="font-size:1.35rem;font-weight:700;color:#085041;margin:0">Tambah Produk</h1>
        <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">Tambah produk baru ke katalog</p>
    </div>
    <a href="{{ route('admin.produk') }}" class="btn-ac-outline btn">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div style="background:#fff;border:1px solid var(--ac-border);border-radius:16px;padding:2rem;max-width:700px">
    @if($errors->any())
    <div class="alert mb-4" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.produk.simpan') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required placeholder="Nama produk">
            </div>
            <div class="col-md-4">
                <label class="form-label">Merek</label>
                <input type="text" name="merek" class="form-control" value="{{ old('merek') }}" placeholder="Nama merek">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih kategori --</option>
                    <option value="cleanser" {{ old('kategori') == 'cleanser' ? 'selected' : '' }}>Cleanser</option>
                    <option value="toner" {{ old('kategori') == 'toner' ? 'selected' : '' }}>Toner</option>
                    <option value="serum" {{ old('kategori') == 'serum' ? 'selected' : '' }}>Serum</option>
                    <option value="moisturizer" {{ old('kategori') == 'moisturizer' ? 'selected' : '' }}>Moisturizer</option>
                    <option value="sunscreen" {{ old('kategori') == 'sunscreen' ? 'selected' : '' }}>Sunscreen</option>
                    <option value="spot_treatment" {{ old('kategori') == 'spot_treatment' ? 'selected' : '' }}>Spot Treatment</option>
                    <option value="mask" {{ old('kategori') == 'mask' ? 'selected' : '' }}>Mask</option>
                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="0">
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi produk">{{ old('deskripsi') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Cocok untuk Jenis Jerawat</label>
                <div class="d-flex gap-3 flex-wrap mt-1">
                    @foreach(['komedo' => '⚫ Komedo', 'papula' => '🔴 Papula', 'pustula' => '🟡 Pustula', 'nodul' => '🟤 Nodul'] as $val => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_jerawat[]" value="{{ $val }}" id="j{{ $val }}"
                            {{ in_array($val, old('jenis_jerawat', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="j{{ $val }}" style="font-size:.875rem">{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                    <label class="form-check-label" for="is_active" style="font-size:.875rem;font-weight:600">Produk Aktif (tampil di katalog)</label>
                </div>
            </div>
        </div>
        <div class="d-flex gap-3 mt-4">
            <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                <i class="bi bi-check-lg me-1"></i>Simpan Produk
            </button>
            <a href="{{ route('admin.produk') }}" class="btn btn-ac-outline py-2 px-4">Batal</a>
        </div>
    </form>
</div>
@endsection