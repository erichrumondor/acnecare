<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    protected $fillable = [
        'user_id','judul','slug','konten',
        'foto','kategori','is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->morphMany(LikeBookmark::class, 'likeable')
            ->where('tipe', 'like');
    }

    public function bookmarks() {
        return $this->morphMany(LikeBookmark::class, 'likeable')
            ->where('tipe', 'bookmark');
    }
}