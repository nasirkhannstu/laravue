<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
use Session;

class ProfileController extends Controller
{
    public function index($slug){
    	$user = User::where('slug', $slug)->first();
    	return view('profile.profile')->withUser($user);
    }

    public function edit(){
    	$user = User::find(Auth::id());
    	//dd($user);
    	return view('profile.edit')->withUser($user);
    }
    public function profileUpdate(Request $r){
    	$this->validate($r, [
    		'phone' => 'required|string|max:255',
    		'fb' => 'required|string|max:255',
    		'district' => 'required|string|max:255',
    		'postcode' => 'required|integer',
    		'about' => 'required|max:255'
    	]);
    	//dd($r);
    	$profile = Profile::where('user_id', Auth::id())->first();
    	//dd($profile);
    	$profile->phone = $r->phone;
    	$profile->fb = $r->fb;
    	$profile->district = $r->district;
    	$profile->postcode = $r->postcode;
    	$profile->about = $r->about;
    	$profile->save();

    	Session::flash('success', 'Profile Informations updated successfully');
    	return redirect()->back();
    }
    public function accountUpdate(Request $r){
    	$this->validate($r, [
    		'fullname' => 'required|string|max:255',
    		'nicname' => 'required|string|max:255',
    		'avatar' => 'sometimes|image'
    	]);
    	$account = User::find(Auth::id());
    	$account->fullname = $r->fullname;
    	$account->nicname = $r->nicname;

    	if($r->hasFile('avatar')){
    		$account->avatar = $r->avatar->store('public/avatars');
    	}
    	$account->save();

    	Session::flash('success', 'Account Informations SAVED');
    	return redirect()->back();
    }
}
