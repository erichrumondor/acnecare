@extends('admin.layouts.app')
@section('title', 'Manajemen Produk')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 style="font-size:1.35rem;font-weight:700;color:#085041;margin:0">
            <i class="bi bi-bag-heart me-2"></i>Manajemen Produk
        </h1>
        <p style="font-size:.875rem;color:var(--ac-muted);margin:4px 0 0">
            Total {{ $produk->total() }} produk dalam katalog
        </p>
    </div>
    <a href="{{ route('admin.produk.buat') }}" class="btn btn-ac-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Produk
    </a>
</div>

<div style="background:#fff;border:1px solid var(--ac-border);border-radius:16px;overflow:hidden">
    <table class="table table-hover mb-0">
        <thead style="background:#F8FDFB">
            <tr>
                <th style="padding:1rem 1.25rem">Produk</th>
                <th>Kategori</th>
                <th>Jenis Jerawat</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $p)
            <tr>
                <td style="padding:1rem 1.25rem">
                    <div style="font-weight:600;color:#085041">{{ $p->nama }}</div>
                    <div style="font-size:.775rem;color:var(--ac-muted)">{{ $p->merek }}</div>
                </td>
                <td>
                    <span style="font-size:.775rem;background:#E6F1FB;color:#185FA5;padding:3px 10px;border-radius:999px;font-weight:600">
                        {{ ucfirst(str_replace('_',' ',$p->kategori)) }}
                    </span>
                </td>
               <td>
    @php
        $jenis = is_array($p->jenis_jerawat)
            ? $p->jenis_jerawat
            : json_decode($p->jenis_jerawat, true);
    @endphp
    @if($jenis)
        @foreach($jenis as $j)
        <span style="font-size:.72rem;background:#E1F5EE;color:#085041;padding:2px 8px;border-radius:999px;font-weight:600;margin-right:3px">{{ ucfirst($j) }}</span>
        @endforeach
    @else
        <span style="font-size:.775rem;color:var(--ac-muted)">—</span>
    @endif
</td>
                <td style="font-size:.875rem;font-weight:600;color:#085041">
                    @if($p->harga)
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    @else
                        <span style="color:var(--ac-muted)">—</span>
                    @endif
                </td>
                <td>
                    @if($p->is_active)
                        <span class="badge-published">Aktif</span>
                    @else
                        <span class="badge-draft">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.produk.edit', $p->id) }}" class="btn btn-sm" style="background:#E6F1FB;color:#185FA5;border-radius:8px;font-size:.8rem;border:none">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.produk.hapus', $p->id) }}" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FAECE7;color:#D85A30;border-radius:8px;font-size:.8rem;border:none">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:3rem;color:var(--ac-muted)">
                    <i class="bi bi-bag-x" style="font-size:2rem;display:block;margin-bottom:.5rem"></i>
                    Belum ada produk
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $produk->links() }}</div>
@endsection