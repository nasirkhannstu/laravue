<?php

namespace App\Traits;
use App\Donar;

trait Donatable{
	public function blood_request($user_requested_id){
		if($this->id === $user_requested_id){
			return 0;
		}
		if($this->is_available($user_requested_id) === 1){
			return "Already Friend.";
		}
		if($this->has_panding_blood_request_to($user_requested_id) === 1){
			return "Already sent a friend request.";
		}
		if($this->has_panding_blood_request_from($user_requested_id) === 1){
			return $this->accept_blood_request($user_requested_id);
		}
		$donar = Donar::create([
			'requester' => $this->id,
			'user_requested' => $user_requested_id
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
	public function donations(){
		$donations = array();
		$f1 = Donar::where('status', 1)->where('requester', $this->id)->get();
		foreach ($f1 as $donar) {
			array_push($donations, \App\User::find($donar->user_requested));
		}
		return $donations;
	}
	public function is_available($user_id){
		$lastDonate = Donar::where('status', 1)->where('requester', $this->id)->orderBy('id', 'DESC')->get();
		// create a DateTime representation of your start date
		// where $date is date in database
		$date = new DateTime($lastDonate->created_at);

		// create a DateIntveral representation of 3 months
		$mdate = new DateInterval('3M');

		// add DateInterval to DateTime
		$date->add($mdate);

		// compare $resetDate to today’s date
		$difference = $date->diff(new DateTime());
		if ($difference->m > 3) {
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