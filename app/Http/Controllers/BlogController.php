<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Neasted_Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request){
    //   $query = $request->get('search');
    //   if($request->ajax()){
    //     $query = $request->get('search');
    //     dd($query);

    //  //   dd('ab');
    //    //console.log($query);
    //   // die;
    //   }
     // dd('ab');
      //  dd($search);
      //  $user_id=Auth::id();
        // dd($user_id);
        $categories=Category::all();
        $search = $request->input('search');
       // $query = $request->input('search');
        $category_id = $request->input('category');
        //$Posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $Posts = Post::when($search, function ($query) use ($search) {
          return $query->where('title', 'LIKE', "%{$search}%")
                       ->orWhere('content', 'LIKE', "%{$search}%")
                       ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
                       
      })
      ->when($category_id, function ($query) use ($category_id) {
          return $query->where('category_id', $category_id);
      })
      ->orderBy('created_at', 'desc')
      ->paginate(6);
        
      //  dd($Posts);
      if ($request->ajax()) {
        return view('Blog.partials.post-list', compact('Posts', 'categories'))->render();
    }

       
   
         return view('blog.index',compact('Posts','categories'));
    }
    //show blog
    public function show($id){
        //dd($id);
        $post=Post::where('id',$id)->first();
      //  $user_id=Auth::id();
        $user=User::where('id',$post->author_id)->first();
        $category=Category::where('id',$post->category_id)->first();
      //  $comments=Comment::where('post_id',$id)->where('status',1)->with(['user','reply'])->latest()->get();
      $comments = Neasted_Comment::where('post_id', $id)
      ->whereNull('parent_id')
      ->with('replies')
      ->latest()
      ->get();
      //  dd($comments);
       // dd($category);
      // $content=htmlspecialchars($post->content);
      //  dd(($content));
      // dd($user->name);
       $data=[
        'id'=>$post->id,
        'title'=>$post->title,
        'content'=>$post->content,
        'Category'=>$category->name,
        'created_at'=>$post->created_at,
        'image'=>$post->image,
        'author_name'=>$user->name,
       ];

       return view('Blog.show',compact('data','comments'));

    }

    //comment store
    public function store($id,request $request){
       // dd($request->all());
        $request->validate([
            'comment'=>'required',
        ]);
      //  dd($request->all());
       $comment=new Comment();
       $comment->user_id=$request->user_id;
       $comment->post_id=$id;
       $comment->content=$request->comment;
       $comment->save();

       return back()->with('success','your comment added');
    }
}
