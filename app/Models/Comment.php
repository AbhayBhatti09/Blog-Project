<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

   // protected $table="category";
    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'parent_id',
       
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function reply(){
        return $this->hasMany(Reply::class,'comment_id')->where('status', 1);
    }
   
}
