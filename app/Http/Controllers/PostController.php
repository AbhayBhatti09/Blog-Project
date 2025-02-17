<?php

namespace App\Http\Controllers;
use Session;
use Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
      $user_id=Auth::id();
     // dd($user_id);
     $user=User::where('id',$user_id)->first();
     
     //dd($user);
     $Posts=Post::where('author_id',$user_id)
     ->with(['category','user'])->latest()->paginate(5);
   //  dd($Posts);


      return view('post.index',compact('Posts'));
    }

    public function create(){
        $user_id=Auth::id();
        $user=User::where('id',$user_id)->first();
        $categories=Category::all();
       // dd($category);
      //  dd($user);
      $data=[
        'id'=>$user->id,
        'name'=>$user->name,
       
      ];

        return view('post.create',compact('data','categories'));
    }

    //store
    public function store(request $request){
      //  dd($request->all());
      $request->validate([
        'title'=>'required',
        'content'=>'required',   
        'author_name'=>'required',
        'category_name'=>'required',
        'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',

      ]);
      //dd($request->all());
      $Post=new Post();
      $Post->title=$request->title;
      $Post->content=$request->content;
      $Post->author_id=$request->author_name;
      $Post->category_id=$request->category_name;

      //image 
      $imageName = time().'.'.$request->image->extension();  
      $request->image->move(public_path('images'), $imageName);
      $Post->image=$imageName;

      $Post->save();
      return redirect('post')->with('success','Your Post added successfully');
    }

    //edit post data
    public function edit($id){
      $post=Post::where('id',$id)->first();
      $user_id=Auth::id();
      $user=User::where('id',$user_id)->first();
      $categories=Category::all();
     // dd($category);
    //  dd($user);
    $data=[
      'id'=>$user->id,
      'name'=>$user->name,
     
    ];
   
   return view('post.edit',compact('post','data','categories'));
    }

    //post update data 
    public function update($id,request $request){
      //dd($id);
    //  dd($request->all());
      $request->validate([
        'title'=>'required',
        'content'=>'required',
        'author_name'=>'required',
        'category_name'=>'required',
       // 'image'=>'required',
      ]);
     // dd($request->all());
     //image
     if($request->image){
      $imageName = time().'.'.$request->image->extension();  
      $request->image->move(public_path('images'), $imageName);
      $post=Post::where('id',$id)->update(['title'=>$request->title,'content'=>$request->content,'author_id'=>$request->author_name,'category_id'=>$request->category_name,'image'=>$imageName]);

     }else{
      $post=Post::where('id',$id)->update(['title'=>$request->title,'content'=>$request->content,'author_id'=>$request->author_name,'category_id'=>$request->category_name]);

     }
     // $Post->image=$imageName;


      return redirect('post')->with('success','Post Updated Successfully');
    }

    // post delete 
    public function delete($id){
      //dd($id);
      $post=Post::findOrFail($id);
      $post->delete();
      return redirect('post')->with('success','post deleted successfully');
    }

    //Blog 
  //   public function blog(){
  //     $user_id=Auth::id();
  //    // dd($user_id);
  //    $Posts=Post::where('author_id',$user_id)
  //    ->with(['category'])->latest()->paginate(5);
  //  //  dd($Posts);


  //     return view('post.blog',compact('Posts'));
  //   }

  public function softindex(){
    $Posts = Post::onlyTrashed()->with(['category'])->latest()->paginate(5);
    return view('post.softdeleteindex',compact('Posts'));

   // dd($posts);
    
  }
  public function restore($id){
   // dd($id);
    $post = Post::withTrashed()->find($id);
    $post->restore();
    return back()->with('success','Post restored return');
  }
  public function restore_all(){
    $post = Post::withTrashed();
    $post->restore();
    return back()->with('success','Post restored return All');
  }
}
