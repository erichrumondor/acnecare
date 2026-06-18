<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model {
    protected $fillable = [
        'user_id','forum_post_id','konten','parent_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(ForumPost::class, 'forum_post_id');
    }

    public function replies() {
        return $this->hasMany(ForumComment::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(ForumComment::class, 'parent_id');
    }
}