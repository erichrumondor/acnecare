<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\ArtikelAdminController;
use App\Http\Controllers\Admin\ProdukAdminController;

// ── PUBLIK ──
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// ── PUBLIK LANJUTAN ──
Route::get('/artikel',        [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'detail'])->name('artikel.detail');
Route::get('/forum',          [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/buat',     [ForumController::class, 'buat'])->name('forum.buat');
Route::get('/forum/{id}',     [ForumController::class, 'detail'])->name('forum.detail');

// ── BUTUH LOGIN ──
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Jurnal
    Route::get('/jurnal',              [JurnalController::class, 'index'])->name('jurnal.index');
    Route::get('/jurnal/buat',         [JurnalController::class, 'buat'])->name('jurnal.buat');
    Route::post('/jurnal/simpan',      [JurnalController::class, 'simpan'])->name('jurnal.simpan');
    Route::get('/jurnal/{id}',         [JurnalController::class, 'detail'])->name('jurnal.detail');
    Route::get('/jurnal/{id}/edit',    [JurnalController::class, 'edit'])->name('jurnal.edit');
    Route::put('/jurnal/{id}/update',  [JurnalController::class, 'update'])->name('jurnal.update');
    Route::delete('/jurnal/{id}/hapus',[JurnalController::class, 'hapus'])->name('jurnal.hapus');

    // Konsultasi
    Route::get('/konsultasi',            [KonsultasiController::class, 'index'])->name('konsultasi');
    Route::get('/konsultasi/mulai',      [KonsultasiController::class, 'mulai'])->name('konsultasi.mulai');
    Route::post('/konsultasi/jawab',     [KonsultasiController::class, 'jawab'])->name('konsultasi.jawab');
    Route::get('/konsultasi/hasil/{id}', [KonsultasiController::class, 'hasil'])->name('konsultasi.hasil');
    Route::get('/konsultasi/riwayat',    [KonsultasiController::class, 'riwayat'])->name('konsultasi.riwayat');

    // Produk
    Route::get('/produk',              [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/tambah',       [ProdukController::class, 'tambah'])->name('produk.tambah');
    Route::post('/produk/simpan',      [ProdukController::class, 'simpan'])->name('produk.simpan');
    Route::put('/produk/{id}/nonaktif',[ProdukController::class, 'nonaktif'])->name('produk.nonaktif');
    Route::delete('/produk/{id}/hapus',[ProdukController::class, 'hapus'])->name('produk.hapus');

    // Profil
    Route::get('/profil',          [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update',   [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'gantiPassword'])->name('profil.password');

    // Forum (butuh login)
    Route::post('/forum/simpan',        [ForumController::class, 'simpan'])->name('forum.simpan');
    Route::post('/forum/{id}/komentar', [ForumController::class, 'komentar'])->name('forum.komentar');
    Route::delete('/forum/{id}/hapus',  [ForumController::class, 'hapus'])->name('forum.hapus');
});

// ── ADMIN ──
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',         [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('/users',             [UserAdminController::class, 'index'])->name('users');
    Route::put('/users/{id}/toggle', [UserAdminController::class, 'toggle'])->name('users.toggle');
    Route::get('/artikel',           [ArtikelAdminController::class, 'index'])->name('artikel');
    Route::get('/artikel/buat',      [ArtikelAdminController::class, 'buat'])->name('artikel.buat');
    Route::post('/artikel/simpan',   [ArtikelAdminController::class, 'simpan'])->name('artikel.simpan');
    Route::get('/artikel/{id}/edit', [ArtikelAdminController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}',      [ArtikelAdminController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}',   [ArtikelAdminController::class, 'hapus'])->name('artikel.hapus');
    Route::get('/produk',            [ProdukAdminController::class, 'index'])->name('produk');
    Route::get('/produk/buat',       [ProdukAdminController::class, 'buat'])->name('produk.buat');
    Route::post('/produk/simpan',    [ProdukAdminController::class, 'simpan'])->name('produk.simpan');
    Route::get('/produk/{id}/edit',  [ProdukAdminController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}',       [ProdukAdminController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}',    [ProdukAdminController::class, 'hapus'])->name('produk.hapus');
});

// ── AUTH (dari Breeze) ──
require __DIR__.'/auth.php';