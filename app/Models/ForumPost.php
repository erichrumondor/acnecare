<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model {
    protected $fillable = [
        'user_id','judul','konten','topik','views'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(ForumComment::class);
    }

    public function likes() {
        return $this->morphMany(LikeBookmark::class, 'likeable')
            ->where('tipe', 'like');
    }
}