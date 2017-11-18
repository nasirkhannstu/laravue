<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Feed;
use App\Profile;
use Auth;

class FeedController extends Controller
{
    public function showFeed(){
        return view('feed.feed')->withUser(Auth::user()->profile);
    }
    // public function feed(){
    // 	$friends = Auth::user()->friends();

    // 	$feed = array();
    // 	foreach($friends as $friend){
    // 		foreach ($friend->posts as $post) { 
    // 			array_push($feed, $post);
    // 		}
    // 	}
    //     foreach(Auth::user()->posts as $post){
    //         array_push($feed, $post);
    //     }
    //     usort($feed, function($p1, $p2){
    //         return $p1->id < $p2->id;
    //     });    
    //     //dd($feed);
    // 	return $feed;
    // }
    public function feeddd(){
        $friends = Auth::user()->friends();
        $feed = array();
        foreach($friends as $friend){
            foreach ($friend->posts as $post){ 
                array_push($feed, $post);
            }
        }
        //dd($feed);
        foreach(Auth::user()->posts as $post){
            array_push($feed, $post);
        }
        $donars = Profile::where('blood', 1)->get();
        foreach($donars as $donar){
            array_push($feed, $donar);
        }
        usort($feed, function($p1, $p2){
            return $p1->created_at < $p2->created_at;
        });
        //dd($feed);
        return $feed;
    }
    public function feedOld(){
        $feeds = Feed::all();
        $userfeed = array();
        foreach($feeds as $feed){
            if($feed->type == 'post'){
                $feed->data = json_decode($feed->data);
                $post = Post::find($feed->type_id);
                $feed = ['feed' => $feed, 'post' => $post];
                array_push($userfeed, $feed);
            }elseif ($feed->type == 'blood') {
                $profile = Profile::find($feed->type_id);
                $feed = ['feed' => $feed, 'profile' => $profile];
                array_push($userfeed, $feed);
            }elseif ($feed->type == 'donation') {
                $feed->data = json_decode($feed->data);
                $profile = Profile::find($feed->creator);
                $feed = ['feed' => $feed, 'profile' => $profile];
                array_push($userfeed, $feed);
            }
        }
        usort($userfeed, function($p1, $p2){
            return $p1['feed']['created_at'] < $p2['feed']['created_at'];
        });
        return $userfeed;
    }
    public function feed(){
        $userfeed = array();
        $page = 0;

        $products = Post::orderby('id', 'desc')->skip($page*10)->take(10)->get();
        foreach($products as $product){
            $productfeed = ['feed' => 'product', 'post' => $product];
            array_push($userfeed, $productfeed);
        }

        $donars = Profile::orderby('id', 'desc')->where('blood', 1)->limit(2)->get();
        foreach($donars as $donar){
            $donarfeed = ['feed' => 'blood', 'post' => $donar];
            array_push($userfeed, $donarfeed);
        }

        usort($userfeed, function($p1, $p2){
            return $p1['post']['created_at'] < $p2['post']['created_at'];
        });
        return $userfeed;
    }
    public function pagefeed($id){
        $userfeed = array();

        $products = Post::where('page_id', $id)->orderby('id', 'desc')->get();
        foreach($products as $product){
            $productfeed = ['feed' => 'product', 'post' => $product];
            array_push($userfeed, $productfeed);
        }
        usort($userfeed, function($p1, $p2){
            return $p1['post']['created_at'] < $p2['post']['created_at'];
        });
        return $userfeed;
    }
}
