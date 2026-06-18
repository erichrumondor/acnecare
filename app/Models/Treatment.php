<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model {
    protected $fillable = [
        'user_id','product_id','nama_produk',
        'waktu_pakai','frekuensi','mulai_pakai',
        'selesai_pakai','is_active','catatan'
    ];

    protected $casts = [
        'mulai_pakai'   => 'date',
        'selesai_pakai' => 'date',
        'is_active'     => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

 public function getWaktuLabelAttribute() {
    switch($this->waktu_pakai) {
        case 'pagi':       return 'Pagi';
        case 'malam':      return 'Malam';
        case 'pagi_malam': return 'Pagi & Malam';
        default:           return '-';
    }
}
}