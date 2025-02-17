<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Reply;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments=Comment::orderBy('created_at', 'desc')->paginate(5);
        $users=User::all();
        $posts=Post::all();
        
        return view('comment.index',compact('comments','users','posts'));
    }

    //comment status change
    public function status($id){
       // dd($id);

        $comment=Comment::where('id',$id)->update(['status'=>1]);
        return redirect('comment')->with('success','Comment Approved');
       // dd($comment);
    }

    public function disable($id){
        //dd($id);

        $comment=Comment::where('id',$id)->update(['status'=>0]);
        return redirect('comment')->with('success','Comment disabled');
       // dd($comment);
    }

    public function storeReply(Request $request, $commentId)
{
    $request->validate([
        'reply' => 'required|string|max:255',
    ]);

    $reply = new Reply();
    $reply->comment_id = $commentId;
    $comment=Comment::where('id',$commentId)->first();
    $Post=Post::where('id',$comment->post_id)->first();
 //   dd($Post);
    $reply->user_id = auth()->id(); 
    $reply->reply = $request->reply;
    $reply->post_id=$Post->id;
    $reply->save();

    return back(); 
}

public function delete($id)
{
   // dd($id);
    $comment = Comment::findOrFail($id);
    $comment->delete(); 
    return redirect('comment')->with('success','Comment deleted');
}
public function softindex(){
    $comments=Comment::onlyTrashed()->orderBy('created_at', 'desc')->paginate(5);
    $users=User::all();
    $posts=Post::all();
  

    return view('comment.softdelete',compact('comments','users','posts'));
}
public function restore($id){
    // dd($id);
     $comment = Comment::withTrashed()->find($id);
     $comment->restore();
     return back()->with('success','Comment restored return');
   }

   public function restore_all(){
    $comment = Comment::withTrashed();
    $comment->restore();
    return back()->with('success','Comment restored return All');
  }

}
