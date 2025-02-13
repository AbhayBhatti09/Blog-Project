<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $user_id=Auth::id();
        // dd($user_id);
        $categories=Category::all();
        $Posts=Post::where('author_id',$user_id)
        ->with(['category'])->latest()->paginate(5);
      //  dd($Posts);
   
        $search = request()->get('search');
        if ($search) {
            $Posts->where('title', 'like', '%' . $search . '%')->latest()->paginate(5);
        }
       // dd($search);
            $categoryId = request()->get('category');
            if ($categoryId) {
                $Posts->where('category_id', $categoryId)->latest()->paginate(5);
            }
      
   
         return view('blog.index',compact('Posts','categories','search'));
    }
    //show blog
    public function show($id){
        //dd($id);
        $post=Post::where('id',$id)->first();
        $user_id=Auth::id();
        $user=User::where('id',$post->author_id)->first();
        $category=Category::where('id',$post->category_id)->first();
       // dd($category);
       // dd($post);
      // dd($user->name);
       $data=[
        'title'=>$post->title,
        'content'=>$post->content,
        'Category'=>$category->name,
        'created_at'=>$post->created_at,
        'image'=>$post->image,
        'author_name'=>$user->name,
       ];

       return view('Blog.show',compact('data'));

    }
}
