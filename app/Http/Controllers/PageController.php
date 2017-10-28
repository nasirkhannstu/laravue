<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Address;
use Session;
use Auth;
use Image;

class PageController extends Controller
{
    public function createBusiness(){
        return view('page.createPage')->withUser(Auth::user()->profile);
    }
    public function createStore(Request $request){
        $this->validate($request, array(
                'name'          => 'required|max:255',
                'slug'           => 'required|alpha_dash|min:5|max:255|unique:pages,slug',
                'description'    => 'string',
                'banner'    => 'sometimes|image'
            ));
        //dd($request->name);
        $page = new Page;
        $page->user_id = Auth::user()->id;
        $page->category_id = 1;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->description = $request->description;

        if($request->hasFile('banner')){
            $image = $request->file('banner');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/storeBanner/'. $filename);
            Image::make($image)->save($location);

            $page->banner = $filename;
        }
        $page->save();

        $address = new Address;
        $address->user_id = Auth::id();
        $address->page_id = $page->id;
        $address->save();

        Session::flash('success','Your sore created successfully.!');
        return redirect()->route('createStore');
    }
    public function editStoreInfo($slug){
    	$page =  Page::where('slug', '=', $slug)->first();
    	return view('page.editinfo')->withPage($page);
    }
    public function viewStore($slug){
        $page =  Page::where('slug', '=', $slug)->first();

        return view('page.storeView')->withPage($page);
    }
    public function pageInfo($id){
        $page =  Page::find($id);

        return $page->address;
    }
    public function savepageinfo(Request $request){
        $validator = \Validator::make($request->all(), [
            'district_id'          => 'required|integer',
            'thana_id'          => 'required|integer',
            'zip'          => 'required|integer',
            'address'    => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg'=>'Something Went Wrong. Please check Again, Thanks.']);
           //return response()->json($validator->errors(), 422);
        }
        
        $address = Address::find($request->id);
        $address->district_id = $request->district_id;
        $address->thana_id = $request->thana_id;
        $address->zip = $request->zip;
        $address->address = $request->address;
        $address->save();

        return response()->json(['msg'=>'Address Saved']);
    }
}
