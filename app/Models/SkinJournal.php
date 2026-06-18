<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkinJournal extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'rating',
        'kondisi',
        'catatan',
        'foto',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'rating'  => 'integer',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Label rating
    public function getRatingLabelAttribute()
{
    switch($this->rating) {
        case 1: return 'Sangat Buruk';
        case 2: return 'Buruk';
        case 3: return 'Cukup';
        case 4: return 'Baik';
        case 5: return 'Sangat Baik';
        default: return 'Cukup';
    }
}

public function getRatingColorAttribute()
{
    switch($this->rating) {
        case 1:
        case 2: return 'danger';
        case 3: return 'warning';
        case 4:
        case 5: return 'success';
        default: return 'secondary';
    }
}
}