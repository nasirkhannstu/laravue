<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function address(){
        return $this->hasOne('App\Address');
    }
    public function posts(){
    	return $this->hasMany('App\Post');
    }
}
