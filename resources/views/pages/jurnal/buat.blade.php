
@extends('layouts.app')
@section('title', 'Tambah Jurnal')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .form-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .form-label { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); margin-bottom:.4rem; }
    .form-control, .form-select {
        border:1px solid var(--ac-border); border-radius:10px;
        font-size:.875rem; padding:.65rem 1rem;
        font-family:'Plus Jakarta Sans',sans-serif;
        transition:border-color .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color:var(--ac-green); box-shadow:0 0 0 3px rgba(29,158,117,.1);
    }
    .rating-group { display:flex; gap:8px; flex-wrap:wrap; }
    .rating-btn input { display:none; }
    .rating-btn label {
        display:flex; flex-direction:column; align-items:center; gap:4px;
        padding:.6rem 1rem; border:1.5px solid var(--ac-border);
        border-radius:12px; cursor:pointer; transition:all .15s;
        font-size:.8rem; font-weight:500; color:var(--ac-muted);
        min-width:72px;
    }
    .rating-btn label i { font-size:1.25rem; color:#E5E7EB; }
    .rating-btn input:checked + label { border-color:var(--ac-green); background:var(--ac-green-light); color:var(--ac-green-dark); }
    .rating-btn input:checked + label i { color:#F59E0B; }
    .rating-btn label:hover { border-color:var(--ac-green-mid); }
    .kondisi-group { display:flex; gap:8px; }
    .kondisi-btn input { display:none; }
    .kondisi-btn label {
        flex:1; text-align:center; padding:.6rem;
        border:1.5px solid var(--ac-border); border-radius:10px;
        cursor:pointer; font-size:.8rem; font-weight:600;
        transition:all .15s;
    }
    .kondisi-btn.membaik input:checked + label { border-color:#1D9E75; background:#E1F5EE; color:#085041; }
    .kondisi-btn.stabil input:checked + label { border-color:#F59E0B; background:#FAEEDA; color:#633806; }
    .kondisi-btn.memburuk input:checked + label { border-color:#D85A30; background:#FAECE7; color:#993C1D; }
    .photo-area {
        border:2px dashed var(--ac-border); border-radius:12px;
        padding:2rem; text-align:center; cursor:pointer;
        transition:all .2s; position:relative;
    }
    .photo-area:hover { border-color:var(--ac-green-mid); background:var(--ac-green-light); }
    .photo-area input { position:absolute; inset:0; opacity:0; cursor:pointer; }
    #preview-img { width:100%; max-height:200px; object-fit:cover; border-radius:10px; display:none; margin-top:1rem; }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="{{ route('jurnal.index') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="form-card">
        <h1 style="font-size:1.35rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.35rem">
            <i class="bi bi-journal-plus me-2 text-ac"></i>Tambah Jurnal Kulit
        </h1>
        <p style="font-size:.85rem;color:var(--ac-muted);margin-bottom:1.75rem">Catat kondisi kulitmu hari ini secara jujur ya!</p>

        @if($errors->any())
        <div class="alert" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem;margin-bottom:1.25rem">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Ada yang perlu diperbaiki:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('jurnal.simpan') }}" enctype="multipart/form-data">
            @csrf

            {{-- Tanggal --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-calendar3 me-1"></i>Tanggal</label>
                <input type="date" name="tanggal" class="form-control"
                    value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>

            {{-- Rating --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-star me-1"></i>Rating Kondisi Kulit</label>
                <div class="rating-group">
                    @foreach([1=>'Sangat Buruk', 2=>'Buruk', 3=>'Cukup', 4=>'Baik', 5=>'Sangat Baik'] as $val => $lbl)
                    <div class="rating-btn">
                        <input type="radio" name="rating" id="r{{ $val }}" value="{{ $val }}"
                            {{ old('rating', 3) == $val ? 'checked' : '' }}>
                        <label for="r{{ $val }}">
                            <i class="bi bi-star-fill"></i>
                            {{ $val }} — {{ $lbl }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Kondisi --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-activity me-1"></i>Kondisi Hari Ini</label>
                <div class="kondisi-group">
                    <div class="kondisi-btn membaik">
                        <input type="radio" name="kondisi" id="kmembaik" value="membaik"
                            {{ old('kondisi') == 'membaik' ? 'checked' : '' }}>
                        <label for="kmembaik">📈 Membaik</label>
                    </div>
                    <div class="kondisi-btn stabil">
                        <input type="radio" name="kondisi" id="kstabil" value="stabil"
                            {{ old('kondisi', 'stabil') == 'stabil' ? 'checked' : '' }}>
                        <label for="kstabil">➡️ Stabil</label>
                    </div>
                    <div class="kondisi-btn memburuk">
                        <input type="radio" name="kondisi" id="kmemburuk" value="memburuk"
                            {{ old('kondisi') == 'memburuk' ? 'checked' : '' }}>
                        <label for="kmemburuk">📉 Memburuk</label>
                    </div>
                </div>
            </div>

            {{-- Catatan --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-pencil me-1"></i>Catatan</label>
                <textarea name="catatan" class="form-control" rows="4"
                    placeholder="Ceritakan kondisi kulitmu hari ini... produk yang dipakai, makanan, aktivitas, dll."
                    maxlength="1000">{{ old('catatan') }}</textarea>
                <div style="font-size:.75rem;color:var(--ac-muted);margin-top:4px">Maks. 1000 karakter</div>
            </div>

            {{-- Foto --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-camera me-1"></i>Foto Kondisi Kulit <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <div class="photo-area" id="photoArea">
                    <input type="file" name="foto" id="fotoInput" accept="image/*"
                        onchange="previewFoto(this)">
                    <i class="bi bi-cloud-upload" style="font-size:2rem;color:var(--ac-green-mid);margin-bottom:.5rem;display:block"></i>
                    <div style="font-size:.875rem;font-weight:600;color:var(--ac-green-dark)">Klik atau drag foto ke sini</div>
                    <div style="font-size:.775rem;color:var(--ac-muted);margin-top:3px">JPG, PNG, WebP — Maks. 2MB</div>
                </div>
                <img id="preview-img" src="" alt="Preview foto">
            </div>

            {{-- Tombol --}}
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                    <i class="bi bi-check-lg me-1"></i> Simpan Jurnal
                </button>
                <a href="{{ route('jurnal.index') }}" class="btn btn-ac-outline py-2 px-4">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('preview-img');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush