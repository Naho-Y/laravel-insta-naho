<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    private $comment;
    

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
       
    }

    public function store(Request $request,$post_id)
    {
    $this->comment->post_id = $post_id;
    $this->comment->user_id = auth()->user()->id;
    $this->comment->body = $request->body;
    $this->comment->save();

    return back();
    }
    
   public function destroy($id)
   {
    $this->comment->destroy($id);
    return back();
   }

   

}
