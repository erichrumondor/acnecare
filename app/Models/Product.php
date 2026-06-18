<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'nama','merek','kategori','deskripsi',
        'harga','foto','jenis_jerawat','is_active'
    ];

    protected $casts = [
        'jenis_jerawat' => 'array',
        'is_active' => 'boolean',
        'harga' => 'decimal:2',
    ];

    public function treatments() {
        return $this->hasMany(Treatment::class);
    }
}