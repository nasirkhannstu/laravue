<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;
use Validator;
use App\Post;
use App\Feed;

class PostController extends Controller
{
	public function store(Request $request){

		// Taken form https : // medium. com / @jagadeshanh/image-upload-and-validation-using-laravel-and-vuejs-e71e0f094fbb

	    $validator = Validator::make($request->all(), [
	        'image' => 'required|image64:jpeg,jpg,png'
	    ]);
	    if ($validator->fails()) {
	        return response()->json(['errors'=>$validator->errors()]);
	    } else {
	        $imageData = $request->get('image');
	        $fileName = time().'-'.Auth::id().'-'.$request->page_id. '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
	        $location = public_path('uploads/storeProduct/'. $fileName);
	        Image::make($request->get('image'))->save($location);
	    }

		$post = Post::create([
			'user_id' => Auth::id(),
			'page_id' => $request->page_id,
			'type' => 'product',
			'image' => $fileName,
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
