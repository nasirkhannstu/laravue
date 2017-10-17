<?php

namespace App\Traits;
use App\Donar;
use App\Profile;
use DateTime;
use Carbon\Carbon;

trait Donatable{
	public function send_blood_request($user_requested_id){
		if($this->id == $user_requested_id){
			return 0;
		}
		if($this->pending($user_requested_id) === 1){
			return "Already sent a blood request.";
		}
		$donar = Donar::create([
			'requester' => $user_requested_id,
			'user_requested' => $this->id
		]);
		if($donar){
			return 1;
		}else{
			return 0;
		}
	}
	public function accept_blood_request($requester){
		if($this->has_panding_blood_request_from($requester) === 0){
			return 0;
		}
		if($this->is_available($requester) === 0){
			return 0;
		}
		$donar = Donar::where('requester', $requester)->where('user_requested', $this->id)->first();
		if($donar){
			$donar->update([
				'status' => 1
			]);
			return 1;
		}else{
			return 0;
		}
	}
	public function pending($id){
		if(Donar::where('status', 0)->where('user_requested', $this->id)->where('requester', $id)->first()){
			return 1;
		}else{
			return 0;
		}
	}
	// public function available_donators(){
	// 	$donators = array();
	// 	$f1 = Profile::where('blood', 1)->orderBy('id', 'DESC')->get();
	// 	foreach ($f1 as $donar) {
	// 		array_push($donators, $donar);
	// 	}
	// 	return $donators;
	// }
	public function is_available($created_at){
		if((strtotime($created_at) < strtotime('2 day ago'))){
		    return 1;
		}else{
			return 0;
		}
	}
	public function pending_blood_request(){
		$users = array();
		$donars = Donar::where('status', 0)->where('user_requested', $this->id)->get();
		foreach ($donars as $donar) {
			array_push($users, \App\User::find($donar->requester));
		}
		return $users;
	}
	public function pending_blood_request_ids(){
		return collect($this->pending_blood_request())->pluck('id')->toArray();
	}
	public function pending_blood_request_sent(){
		$users = array();
		$donars = Donar::where('status', 0)->where('requester', $this->id)->get();
		foreach ($donars as $donar) {
			array_push($users, \App\User::find($donar->user_requested));
		}
		return $users;
	}
	public function pending_blood_request_sent_ids(){
		return collect($this->pending_blood_request_sent())->pluck('id')->toArray();
	}
	public function has_panding_blood_request_from($user_id){
		if(in_array($user_id, $this->pending_blood_request_ids())){
			return 1;
		}else{
			return 0;
		}
	}
	public function has_panding_blood_request_to($user_id){
		if(in_array($user_id, $this->pending_blood_request_sent_ids())){
			return 1;
		}else{
			return 0;
		}
	}
}