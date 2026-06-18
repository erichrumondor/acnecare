@extends('layouts.app')
@section('title', 'Buat Postingan')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .form-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .form-label { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); margin-bottom:.4rem; }
    .form-control, .form-select { border:1px solid var(--ac-border); border-radius:10px; font-size:.875rem; padding:.65rem 1rem; transition:border-color .2s; }
    .form-control:focus, .form-select:focus { border-color:var(--ac-green); box-shadow:0 0 0 3px rgba(29,158,117,.1); outline:none; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="mb-3">
        <a href="{{ route('forum.index') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i>Kembali ke Forum
        </a>
    </div>

    <div class="form-card">
        <h1 style="font-size:1.35rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.35rem">
            <i class="bi bi-pencil-square me-2 text-ac"></i>Buat Postingan Baru
        </h1>
        <p style="font-size:.85rem;color:var(--ac-muted);margin-bottom:1.75rem">
            Bagikan pengalaman atau pertanyaanmu seputar jerawat
        </p>

        @if($errors->any())
        <div class="alert mb-4" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('forum.simpan') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Topik</label>
                <select name="topik" class="form-select" required>
                    <option value="">-- Pilih topik --</option>
                    <option value="komedo" {{ old('topik') == 'komedo' ? 'selected' : '' }}>⚫ Komedo</option>
                    <option value="papula" {{ old('topik') == 'papula' ? 'selected' : '' }}>🔴 Papula</option>
                    <option value="pustula" {{ old('topik') == 'pustula' ? 'selected' : '' }}>🟡 Pustula</option>
                    <option value="nodul" {{ old('topik') == 'nodul' ? 'selected' : '' }}>🟤 Nodul</option>
                    <option value="produk" {{ old('topik') == 'produk' ? 'selected' : '' }}>🛍️ Produk</option>
                    <option value="tips" {{ old('topik') == 'tips' ? 'selected' : '' }}>💡 Tips</option>
                    <option value="umum" {{ old('topik') == 'umum' ? 'selected' : '' }}>💬 Umum</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Judul Postingan</label>
                <input type="text" name="judul" class="form-control"
                    value="{{ old('judul') }}" required
                    placeholder="Tulis judul yang jelas dan deskriptif">
            </div>
            <div class="mb-4">
                <label class="form-label">Isi Postingan</label>
                <textarea name="konten" class="form-control" rows="6" required
                    placeholder="Ceritakan pengalamanmu, pertanyaan, atau tips yang ingin kamu bagikan...">{{ old('konten') }}</textarea>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                    <i class="bi bi-send me-1"></i>Posting Sekarang
                </button>
                <a href="{{ route('forum.index') }}" class="btn btn-ac-outline py-2 px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection