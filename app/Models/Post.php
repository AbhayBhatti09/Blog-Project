<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
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
   
}
