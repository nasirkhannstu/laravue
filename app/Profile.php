<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = ['user_id', 'phone', 'fb', 'district', 'postcode', 'about' ];

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
