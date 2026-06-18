@extends('admin.layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 style="font-size:1.35rem;font-weight:700;color:#085041;margin:0">Edit Produk</h1>
        <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">{{ $produk->nama }}</p>
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

    <form method="POST" action="{{ route('admin.produk.update', $produk->id) }}">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $produk->nama) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Merek</label>
                <input type="text" name="merek" class="form-control" value="{{ old('merek', $produk->merek) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih kategori --</option>
                    @foreach(['cleanser','toner','serum','moisturizer','sunscreen','spot_treatment','mask','lainnya'] as $kat)
                    <option value="{{ $kat }}" {{ old('kategori', $produk->kategori) == $kat ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $kat)) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga', $produk->harga) }}">
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Cocok untuk Jenis Jerawat</label>
                <div class="d-flex gap-3 flex-wrap mt-1">
                    @foreach(['komedo' => '⚫ Komedo', 'papula' => '🔴 Papula', 'pustula' => '🟡 Pustula', 'nodul' => '🟤 Nodul'] as $val => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="jenis_jerawat[]"
                            value="{{ $val }}" id="j{{ $val }}"
                            {{ in_array($val, old('jenis_jerawat', $produk->jenis_jerawat ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="j{{ $val }}" style="font-size:.875rem">{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                        {{ old('is_active', $produk->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active" style="font-size:.875rem;font-weight:600">Produk Aktif</label>
                </div>
            </div>
        </div>
        <div class="d-flex gap-3 mt-4">
            <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
            </button>
            <a href="{{ route('admin.produk') }}" class="btn btn-ac-outline py-2 px-4">Batal</a>
        </div>
    </form>
</div>
@endsection