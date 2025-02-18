<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;


class Neasted_Comment extends Model
{
    use HasFactory;
    protected $table="neasted_comments";
    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function post() {
        return $this->belongsTo(Post::class);
    }
    public function parent() {
        return $this->belongsTo(Neasted_Comment::class, 'parent_id');
    }

    public function replies() {
        return $this->hasMany(Neasted_Comment::class, 'parent_id')->with('replies');
    }

}
