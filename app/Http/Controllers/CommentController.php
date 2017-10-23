<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function createComment(Request $request){

    	$this->validate($request, array(
                'post_id'          => 'required|integer',
                'content'    => 'Required|max:500|string',
            ));
    	$comment = new Comment;
    	$comment->user_id = Auth::id();
    	$comment->post_id = $request->post_id;
    	$comment->content = $request->content;
    	$comment->save();
    	
    	return $comment;
    }
}
