<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Feed;

class PostController extends Controller
{
	public function store(Request $request){
		$post = Post::create([
			'user_id' => Auth::id(),
			'content' => $request->content
		]);
		$feed = $this->add_feed($request, $post->id);

		$post = Post::find($feed->type_id);
        $feed = ['feed' => $feed, 'post' => $post];

		return $feed;
	}

	private function add_feed($request, $id){
		$data = [
			'id' => 'a',
			'name' => ['f' => 'Nasir','l' => 'Khan'],
			'home' => 'Hobigong'
		];
        $feed = new Feed;
        $feed->creator = Auth::id();
        $feed->type = 'post';
        $feed->type_id = $id;
        $feed->data = json_encode($data);
        $feed->save();
        return $feed;
    }
}
