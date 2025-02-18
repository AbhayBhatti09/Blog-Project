<?php

namespace App\Http\Controllers;
use App\Models\Reply;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Neasted_Comment;

use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index(){
        $Replies=Neasted_Comment::where('parent_id', '!=', null)->orderBy('created_at', 'desc')->with(['user','parent'])->paginate(5);
        $users=User::all();
        $comments=Neasted_Comment::all();
        $posts=Post::all();
       
      //  dd($Replies);

        return view('reply.index',compact('Replies','users','posts','comments'));
    }

    //Reply status
    public function status($id){
        // dd($id);
 
         $reply=Neasted_Comment::where('id',$id)->update(['status'=>1]);
         return redirect('Replies')->with('success','Repliy to comment Approved');
        // dd($comment);
     }

     //disable 
     public function disable($id){
        // dd($id);
 
         $reply=Neasted_Comment::where('id',$id)->update(['status'=>0]);
         return redirect('Replies')->with('success','Repliy to comment Approved');
        // dd($comment);
     }

}
