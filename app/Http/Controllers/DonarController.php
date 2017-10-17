<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Profile;
use App\Donar;
use App\Feed;

class DonarController extends Controller
{
    public function blood(){
        return view('search.blood')->withUser(Auth::user()->profile);
    }
    public function newDoner(Request $request){
        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->bloodgroup = $request->content;
        $profile->blood = 1;
        $profile->save();

        // Need to check if added this day ******
        $this->add_feed($profile->id);

        return $profile;
    }

    public function getAllDonars(){
        return Auth::user()->pending_blood_request();
    }

    public function acceptDonars($id){
        if(Auth::user()->accept_blood_request($id)){
            $this->add_donation_to_feed($id);
            return ["status" => "accepted"];
        }
        return ["status" => "notaccepted"];
    }

    public function get_accepted_donars(){
        return Auth::user()->accepted_blood_request();
    }

    public function cancelDoner(){
        $profile = Profile::where('user_id', Auth::id())->first();
        $profile->bloodgroup = null;
        $profile->blood = 0;
        $profile->save();

        return $profile;
    }

    public function bloodDonars(){
        $availables = array();
        $activates = Profile::where('blood', 1)->orderBy('id', 'DESC')->get();
        foreach ($activates as $activate) {
            if(Auth::user()->is_available($activate->user_id)){
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

    public function check_donation_status(){
        $donar = Profile::where('user_id', Auth::id())->first();
        if($donar->blood == 1){
        return ["status" => "donar"];
        }
        return ["status" => 'notdonar'];
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
    private function add_feed($id){
        $data = [];
        $feed = new Feed;
        $feed->creator = Auth::id();
        $feed->type = 'blood';
        $feed->type_id = $id;
        $feed->data = json_encode($data);
        $feed->save();
    }
    private function add_donation_to_feed($id){
        $profile = Profile::where('user_id', $id)->first();
        $data = [
            'fullname' => $profile->user->fullname,
            'slug' => $profile->user->slug,
            'avatar' => $profile->user->avatar
        ];
        $feed = new Feed;
        $feed->creator = Auth::id();
        $feed->type = 'donation';
        $feed->type_id = $id;
        $feed->data = json_encode($data);
        $feed->save();
    }
}