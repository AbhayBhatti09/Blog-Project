<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Neasted_Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $comments=Neasted_Comment::where('parent_id',null)->orderBy('created_at', 'desc')->paginate(5);
        $users=User::all();
        $posts=Post::all();
        
        return view('comment.index',compact('comments','users','posts'));
    }

    //comment status change
    public function status($id){
       // dd($id);

        $comment=Neasted_Comment::where('id',$id)->update(['status'=>1]);
        return redirect('comment')->with('success','Comment Approved');
       // dd($comment);
    }

    public function disable($id){
        //dd($id);

        $comment=Neasted_Comment::where('id',$id)->update(['status'=>0]);
        return redirect('comment')->with('success','Comment disabled');
       // dd($comment);
    }

    public function storeReply(Request $request, $commentId)
{
   // dd($request->all());
   // dd($request->name);
    $request->validate([
        'reply' => 'required|string|max:255',
    ]);
  
   // dd($commentId);
   if($request->comment_type=='comment'){

  //  dd('ab');
    $reply = new Reply();
    $reply->comment_id = $commentId;
    $comment=Comment::where('id',$commentId)->first();
    $reply->comment_type='comment';
   // dd($comment);
    $Post=Post::where('id',$comment->post_id)->first();
 //   dd($Post);
    $reply->user_id = auth()->id(); 
    $reply->reply = $request->reply;
    $reply->post_id=$Post->id;
    $reply->save();
   // dd($reply->save());
   }
   if($request->comment_type=='reply'){
   // dd($commentId);
   //dd('ab1');
    $reply = new Reply();
    $reply->comment_id = $commentId;
    $reply1=Reply::where('id',$commentId)->first();
    $reply->comment_type='reply ';
   // dd($comment);
    $Post=Post::where('id',$reply1->post_id)->first();
 //   dd($Post);
    $reply->user_id = auth()->id(); 
    $reply->reply = $request->reply;
    $reply->post_id=$Post->id;
    $reply->save();
   // dd($reply->save());

   }
   

    return back(); 
}

public function delete($id)
{
  //  dd($id);
    $comment = Neasted_Comment::findOrFail($id);
    $comment->delete(); 
    return redirect('comment')->with('success','Comment deleted');
}
public function softindex(){
    $comments=Neasted_Comment::onlyTrashed()->orderBy('created_at', 'desc')->paginate(5);
    $users=User::all();
    $posts=Post::all();
  

    return view('comment.softdelete',compact('comments','users','posts'));
}
public function restore($id){
    // dd($id);
     $comment = Neasted_Comment::withTrashed()->find($id);
     $comment->restore();
     return back()->with('success','Comment restored return');
   }

   public function restore_all(){
    $comment = Neasted_Comment::withTrashed();
    $comment->restore();
    return back()->with('success','Comment restored return All');
  }

}
