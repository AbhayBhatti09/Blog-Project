<?php

namespace App\Http\Controllers;
use App\Models\Neasted_Comment;
use Illuminate\Http\Request;

class NeastedCommentController extends Controller
{
    public function store(request $request){
       // dd($request->all());
       if($request->comment_type=="comment"){
        $request->validate([
          'comment' => 'required|string',
           'parent_id' => 'nullable|exists:neasted_comments,id'
         ]);
       }else{
        $request->validate([
          'comment' => 'required|string',
           'parent_id' => 'nullable',
         ]);
       }
      
    //   dd($request->all());
      // dd(auth()->id());
    //    Neasted_Comment::create([
    //     'user_id' => auth()->id(),
    //     'post_id' => $request->post_id,
    //     'parent_id' => $request->parent_id,
    //     'body' => $request->comment,
    // ]);
    $neated_comment=new Neasted_Comment();
    $neated_comment->user_id=auth()->id();
    $neated_comment->post_id=$request->post_id;
    $neated_comment->parent_id=$request->parent_id;
    $neated_comment->body=$request->comment;
   // dd($neated_comment);
    $neated_comment->save();
   // dd($neated_comment->save());
  //  dd($neated_comment);

    if($request->comment_type=='comment'){
      return back()->with('success', 'reply added successfully');
    }else{
      return back()->with('success', 'Comment added successfully');
    }

    

    }
}
