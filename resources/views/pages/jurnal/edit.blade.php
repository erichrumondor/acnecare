@extends('layouts.app')
@section('title', 'Edit Jurnal')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:680px; margin:2rem auto; padding:0 1rem; }
    .form-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .form-label { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); margin-bottom:.4rem; }
    .form-control, .form-select { border:1px solid var(--ac-border); border-radius:10px; font-size:.875rem; padding:.65rem 1rem; font-family:'Plus Jakarta Sans',sans-serif; transition:border-color .2s; }
    .form-control:focus, .form-select:focus { border-color:var(--ac-green); box-shadow:0 0 0 3px rgba(29,158,117,.1); }
    .rating-group { display:flex; gap:8px; flex-wrap:wrap; }
    .rating-btn input { display:none; }
    .rating-btn label { display:flex; flex-direction:column; align-items:center; gap:4px; padding:.6rem 1rem; border:1.5px solid var(--ac-border); border-radius:12px; cursor:pointer; transition:all .15s; font-size:.8rem; font-weight:500; color:var(--ac-muted); min-width:72px; }
    .rating-btn label i { font-size:1.25rem; color:#E5E7EB; }
    .rating-btn input:checked + label { border-color:var(--ac-green); background:var(--ac-green-light); color:var(--ac-green-dark); }
    .rating-btn input:checked + label i { color:#F59E0B; }
    .kondisi-group { display:flex; gap:8px; }
    .kondisi-btn input { display:none; }
    .kondisi-btn label { flex:1; text-align:center; padding:.6rem; border:1.5px solid var(--ac-border); border-radius:10px; cursor:pointer; font-size:.8rem; font-weight:600; transition:all .15s; }
    .kondisi-btn.membaik input:checked + label { border-color:#1D9E75; background:#E1F5EE; color:#085041; }
    .kondisi-btn.stabil input:checked + label { border-color:#F59E0B; background:#FAEEDA; color:#633806; }
    .kondisi-btn.memburuk input:checked + label { border-color:#D85A30; background:#FAECE7; color:#993C1D; }
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
        <h1 style="font-size:1.35rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:1.75rem">
            <i class="bi bi-pencil-square me-2 text-ac"></i>Edit Jurnal
        </h1>

        <form method="POST" action="{{ route('jurnal.update', $jurnal->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control"
                    value="{{ old('tanggal', $jurnal->tanggal->format('Y-m-d')) }}" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Rating Kondisi Kulit</label>
                <div class="rating-group">
                    @foreach([1=>'Sangat Buruk', 2=>'Buruk', 3=>'Cukup', 4=>'Baik', 5=>'Sangat Baik'] as $val => $lbl)
                    <div class="rating-btn">
                        <input type="radio" name="rating" id="r{{ $val }}" value="{{ $val }}"
                            {{ old('rating', $jurnal->rating) == $val ? 'checked' : '' }}>
                        <label for="r{{ $val }}">
                            <i class="bi bi-star-fill"></i>
                            {{ $val }} — {{ $lbl }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Kondisi</label>
                <div class="kondisi-group">
                    @foreach(['membaik'=>'📈 Membaik','stabil'=>'➡️ Stabil','memburuk'=>'📉 Memburuk'] as $val => $lbl)
                    <div class="kondisi-btn {{ $val }}">
                        <input type="radio" name="kondisi" id="k{{ $val }}" value="{{ $val }}"
                            {{ old('kondisi', $jurnal->kondisi) == $val ? 'checked' : '' }}>
                        <label for="k{{ $val }}">{{ $lbl }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" rows="4"
                    placeholder="Ceritakan kondisi kulitmu...">{{ old('catatan', $jurnal->catatan) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Ganti Foto <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                @if($jurnal->foto)
                    <img src="{{ Storage::url($jurnal->foto) }}" alt="Foto saat ini"
                        style="width:100%;max-height:180px;object-fit:cover;border-radius:10px;margin-bottom:.75rem">
                @endif
                <input type="file" name="foto" class="form-control" accept="image/*">
                <div style="font-size:.75rem;color:var(--ac-muted);margin-top:4px">Kosongkan jika tidak ingin ganti foto</div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('jurnal.index') }}" class="btn btn-ac-outline py-2 px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection