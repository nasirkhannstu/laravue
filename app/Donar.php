<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donar extends Model
{
    protected $fillable = ['type','requester','user_requested','status','likes'];
}
