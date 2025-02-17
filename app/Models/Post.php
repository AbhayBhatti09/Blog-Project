<?php

namespace App\Models;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="post";
    protected $fillable = [
        'title',
        'content',
        'author_id',
        'category_id',
       
    ];

     //Relation to Category
     public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    
    //Relation to user
    public function user(){
        return $this->belongsTo(User::class,'author_id','id');
    }
   
}
