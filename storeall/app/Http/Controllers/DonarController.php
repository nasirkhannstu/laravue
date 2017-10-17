<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\Donar;

class DonarController extends Controller
{
    public function blood(){
    	return view('search.blood');
    }
    public function bloodDonars(){
    	$availables = array();
    	$activates = Profile::where('blood', 1)->orderBy('id', 'DESC')->get();
    	foreach ($activates as $activate) {
    		if($donar = Donar::where('status', 1)->where('requester', $activate->id)->first()){
    			if(Auth::user()->is_available($donar->created_at)){
    				array_push($availables, $activate);
                }
            }else{
                array_push($availables, $activate);
            }
    	}
    	return $availables;
    }
    public function check($id){
        if(Auth::user()->pending($id) === 1){
        return ["status" => "pending"];
        }
        return ["status" => 'request'];
    }


    public function request($id){
        $resp = Auth::user()->send_blood_request($id);
        
        // User::find($id)->notify(new \App\Notifications\NewFriendRequest(Auth::user()));
        return $resp;
    }


    public function cancelrequest($id){
        if($donar = Donar::where('status', 0)->where('user_requested',  Auth::id())->where('requester', $id)->first()){
            $donar->delete();
            return 1;
        }
        return 0;
    }
}