@extends('layouts.app')
@section('title', 'Tambah Produk')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:620px; margin:2rem auto; padding:0 1rem; }
    .form-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .form-label { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); margin-bottom:.4rem; }
    .form-control, .form-select { border:1px solid var(--ac-border); border-radius:10px; font-size:.875rem; padding:.65rem 1rem; transition:border-color .2s; }
    .form-control:focus, .form-select:focus { border-color:var(--ac-green); box-shadow:0 0 0 3px rgba(29,158,117,.1); outline:none; }
    .waktu-group { display:flex; gap:8px; }
    .waktu-btn input { display:none; }
    .waktu-btn label { flex:1; text-align:center; padding:.6rem; border:1.5px solid var(--ac-border); border-radius:10px; cursor:pointer; font-size:.8rem; font-weight:600; transition:all .15s; color:var(--ac-muted); }
    .waktu-btn input:checked + label { border-color:var(--ac-green); background:var(--ac-green-light); color:var(--ac-green-dark); }
    .produk-suggest { display:grid; grid-template-columns:repeat(2,1fr); gap:8px; margin-top:.75rem; }
    .suggest-item { background:var(--ac-green-light); border:1.5px solid transparent; border-radius:10px; padding:.6rem .875rem; cursor:pointer; transition:all .15s; }
    .suggest-item:hover { border-color:var(--ac-green); }
    .suggest-item .sn { font-size:.8rem; font-weight:600; color:var(--ac-green-dark); }
    .suggest-item .sm { font-size:.72rem; color:var(--ac-muted); }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="{{ route('produk.index') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="form-card">
        <h1 style="font-size:1.35rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.35rem">
            <i class="bi bi-bag-plus me-2 text-ac"></i>Tambah Produk Perawatan
        </h1>
        <p style="font-size:.85rem;color:var(--ac-muted);margin-bottom:1.75rem">
            Catat produk skincare yang sedang kamu gunakan.
        </p>

        @if($errors->any())
        <div class="alert mb-4" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('produk.simpan') }}">
            @csrf

            {{-- Pilih dari katalog --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-grid me-1"></i>Pilih dari Katalog <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <select name="product_id" class="form-select" onchange="isiDariKatalog(this)">
                    <option value="">-- Pilih produk dari katalog --</option>
                    @foreach($produk as $p)
                    <option value="{{ $p->id }}" data-nama="{{ $p->nama }}">{{ $p->nama }} — {{ $p->merek }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama produk --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-tag me-1"></i>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control"
                    value="{{ old('nama_produk') }}" required
                    placeholder="Contoh: Salicylic Acid 2% Toner" id="namaProduk">
            </div>

            {{-- Waktu pakai --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-clock me-1"></i>Waktu Pakai</label>
                <div class="waktu-group">
                    <div class="waktu-btn">
                        <input type="radio" name="waktu_pakai" id="wpagi" value="pagi" {{ old('waktu_pakai') == 'pagi' ? 'checked' : '' }}>
                        <label for="wpagi">☀️ Pagi</label>
                    </div>
                    <div class="waktu-btn">
                        <input type="radio" name="waktu_pakai" id="wmalam" value="malam" {{ old('waktu_pakai') == 'malam' ? 'checked' : '' }}>
                        <label for="wmalam">🌙 Malam</label>
                    </div>
                    <div class="waktu-btn">
                        <input type="radio" name="waktu_pakai" id="wpagi_malam" value="pagi_malam" {{ old('waktu_pakai', 'pagi_malam') == 'pagi_malam' ? 'checked' : '' }}>
                        <label for="wpagi_malam">🌅 Pagi & Malam</label>
                    </div>
                </div>
            </div>

            {{-- Frekuensi --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-repeat me-1"></i>Frekuensi <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <input type="text" name="frekuensi" class="form-control"
                    value="{{ old('frekuensi') }}"
                    placeholder="Contoh: 2x sehari, 3x seminggu">
            </div>

            {{-- Mulai pakai --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-calendar3 me-1"></i>Mulai Dipakai</label>
                <input type="date" name="mulai_pakai" class="form-control"
                    value="{{ old('mulai_pakai', date('Y-m-d')) }}" required>
            </div>

            {{-- Catatan --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-pencil me-1"></i>Catatan <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <textarea name="catatan" class="form-control" rows="3"
                    placeholder="Reaksi kulit, efek samping, dll.">{{ old('catatan') }}</textarea>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                    <i class="bi bi-check-lg me-1"></i>Simpan Produk
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-ac-outline py-2 px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function isiDariKatalog(select) {
    const nama = select.options[select.selectedIndex].dataset.nama;
    if (nama) document.getElementById('namaProduk').value = nama;
}
</script>
@endpush@extends('layouts.app')
@section('title', 'Tambah Produk')

@push('styles')
<style>
    body { background:#F8FDFB; }
    .ac-main { max-width:620px; margin:2rem auto; padding:0 1rem; }
    .form-card { background:#fff; border:1px solid var(--ac-border); border-radius:20px; padding:2rem; }
    .form-label { font-size:.875rem; font-weight:600; color:var(--ac-green-dark); margin-bottom:.4rem; }
    .form-control, .form-select { border:1px solid var(--ac-border); border-radius:10px; font-size:.875rem; padding:.65rem 1rem; transition:border-color .2s; }
    .form-control:focus, .form-select:focus { border-color:var(--ac-green); box-shadow:0 0 0 3px rgba(29,158,117,.1); outline:none; }
    .waktu-group { display:flex; gap:8px; }
    .waktu-btn input { display:none; }
    .waktu-btn label { flex:1; text-align:center; padding:.6rem; border:1.5px solid var(--ac-border); border-radius:10px; cursor:pointer; font-size:.8rem; font-weight:600; transition:all .15s; color:var(--ac-muted); }
    .waktu-btn input:checked + label { border-color:var(--ac-green); background:var(--ac-green-light); color:var(--ac-green-dark); }
    .produk-suggest { display:grid; grid-template-columns:repeat(2,1fr); gap:8px; margin-top:.75rem; }
    .suggest-item { background:var(--ac-green-light); border:1.5px solid transparent; border-radius:10px; padding:.6rem .875rem; cursor:pointer; transition:all .15s; }
    .suggest-item:hover { border-color:var(--ac-green); }
    .suggest-item .sn { font-size:.8rem; font-weight:600; color:var(--ac-green-dark); }
    .suggest-item .sm { font-size:.72rem; color:var(--ac-muted); }
</style>
@endpush

@section('content')
<div class="ac-main">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="{{ route('produk.index') }}" style="color:var(--ac-muted);text-decoration:none;font-size:.875rem">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>

    <div class="form-card">
        <h1 style="font-size:1.35rem;font-weight:700;color:var(--ac-green-dark);margin-bottom:.35rem">
            <i class="bi bi-bag-plus me-2 text-ac"></i>Tambah Produk Perawatan
        </h1>
        <p style="font-size:.85rem;color:var(--ac-muted);margin-bottom:1.75rem">
            Catat produk skincare yang sedang kamu gunakan.
        </p>

        @if($errors->any())
        <div class="alert mb-4" style="background:#FAECE7;border:none;border-radius:12px;color:#993C1D;font-size:.85rem">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('produk.simpan') }}">
            @csrf

            {{-- Pilih dari katalog --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-grid me-1"></i>Pilih dari Katalog <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <select name="product_id" class="form-select" onchange="isiDariKatalog(this)">
                    <option value="">-- Pilih produk dari katalog --</option>
                    @foreach($produk as $p)
                    <option value="{{ $p->id }}" data-nama="{{ $p->nama }}">{{ $p->nama }} — {{ $p->merek }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Nama produk --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-tag me-1"></i>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control"
                    value="{{ old('nama_produk') }}" required
                    placeholder="Contoh: Salicylic Acid 2% Toner" id="namaProduk">
            </div>

            {{-- Waktu pakai --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-clock me-1"></i>Waktu Pakai</label>
                <div class="waktu-group">
                    <div class="waktu-btn">
                        <input type="radio" name="waktu_pakai" id="wpagi" value="pagi" {{ old('waktu_pakai') == 'pagi' ? 'checked' : '' }}>
                        <label for="wpagi">☀️ Pagi</label>
                    </div>
                    <div class="waktu-btn">
                        <input type="radio" name="waktu_pakai" id="wmalam" value="malam" {{ old('waktu_pakai') == 'malam' ? 'checked' : '' }}>
                        <label for="wmalam">🌙 Malam</label>
                    </div>
                    <div class="waktu-btn">
                        <input type="radio" name="waktu_pakai" id="wpagi_malam" value="pagi_malam" {{ old('waktu_pakai', 'pagi_malam') == 'pagi_malam' ? 'checked' : '' }}>
                        <label for="wpagi_malam">🌅 Pagi & Malam</label>
                    </div>
                </div>
            </div>

            {{-- Frekuensi --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-repeat me-1"></i>Frekuensi <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <input type="text" name="frekuensi" class="form-control"
                    value="{{ old('frekuensi') }}"
                    placeholder="Contoh: 2x sehari, 3x seminggu">
            </div>

            {{-- Mulai pakai --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-calendar3 me-1"></i>Mulai Dipakai</label>
                <input type="date" name="mulai_pakai" class="form-control"
                    value="{{ old('mulai_pakai', date('Y-m-d')) }}" required>
            </div>

            {{-- Catatan --}}
            <div class="mb-4">
                <label class="form-label"><i class="bi bi-pencil me-1"></i>Catatan <span style="font-weight:400;color:var(--ac-muted)">(opsional)</span></label>
                <textarea name="catatan" class="form-control" rows="3"
                    placeholder="Reaksi kulit, efek samping, dll.">{{ old('catatan') }}</textarea>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-ac-primary flex-grow-1 py-2">
                    <i class="bi bi-check-lg me-1"></i>Simpan Produk
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-ac-outline py-2 px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function isiDariKatalog(select) {
    const nama = select.options[select.selectedIndex].dataset.nama;
    if (nama) document.getElementById('namaProduk').value = nama;
}
</script>
@endpush