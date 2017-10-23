<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
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

        Session::flash('success','Your sore created successfully.!');
        return redirect()->route('createStore');
    }
    public function viewStore($slug){
    	$page =  Page::where('slug', '=', $slug)->first();

    	return view('page.storeView')->withPage($page);
    }
}
