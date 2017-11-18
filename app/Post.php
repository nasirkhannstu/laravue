<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
	public $with = ['user', 'likes', 'comments', 'page'];

    protected $fillable = ['content', 'user_id', 'page_id', 'type', 'name', 'price', 'qty', 'discount', 'image', 'created_at'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function likes(){
    	return $this->hasMany('App\Like');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function page(){
        return $this->belongsTo('App\Page');
    }
    public function getImageAttribute($image){
        return url('uploads/storeProduct/'.$image);
    }
}
