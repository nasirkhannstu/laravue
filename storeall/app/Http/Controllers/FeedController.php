<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Profile;
use Auth;

class FeedController extends Controller
{
    private function add_feed(){
        $this->validate($r, [
            'creator' => 'required|integer',
            'type' => 'required|string',
            'model' => 'required|string',
            'data' => 'required|text'
        ]);

        $feed = new Feed;
        //dd($profile);
        $profile->creator = $r->creator;
        $profile->type = $r->type;
        $profile->model = $r->model;
        $profile->data = $r->data;
        $profile->save();
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
    public function feed(){
        $friends = Auth::user()->friends();
        $feed = array();
        foreach($friends as $friend){
            foreach ($friend->posts as $post){ 
                array_push($feed, $post);
            }
        }
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
}
