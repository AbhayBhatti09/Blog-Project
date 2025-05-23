<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table='reply';
    protected $fillable = ['comment_id', 'user_id', 'content'];

    public function comment()
    {
        return $this->belongsTo(Comment::class)->where('status', 1);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
