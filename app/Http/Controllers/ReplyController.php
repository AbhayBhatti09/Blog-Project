<?php

namespace App\Http\Controllers;
use App\Models\Reply;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index(){
        $Replies=Reply::orderBy('created_at', 'desc')->with(['user','comment'])->paginate(5);
        $users=User::all();
        $comments=Comment::all();
        $posts=Post::all();
       
       // dd($Replies);

        return view('reply.index',compact('Replies','users','posts','comments'));
    }

    //Reply status
    public function status($id){
        // dd($id);
 
         $reply=Reply::where('id',$id)->update(['status'=>1]);
         return redirect('Replies')->with('success','Repliy to comment Approved');
        // dd($comment);
     }

     //disable 
     public function disable($id){
        // dd($id);
 
         $reply=Reply::where('id',$id)->update(['status'=>0]);
         return redirect('Replies')->with('success','Repliy to comment Approved');
        // dd($comment);
     }

}
