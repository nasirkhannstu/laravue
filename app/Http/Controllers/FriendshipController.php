<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FriendshipController extends Controller
{
    public function check($id){
    	if(Auth::user()->is_friend_with($id) === 1){
    		return ["status" => "friends"];
    	}
    	if(Auth::user()->has_panding_friend_request_from($id)){
    		return ["status" => "pending"];
    	}
    	if(Auth::user()->has_panding_friend_request_to($id)){
    		return ["status" => "waiting"];
    	}
    	return ["status" => 0];
    }
    public function add_friend($id){
    	return Auth::user()->add_friend($id);
    }
    public function accept_friend($id){
    	return Auth::user()->accept_friend($id);
    }

}
