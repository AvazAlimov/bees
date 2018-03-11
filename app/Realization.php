<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Realization extends Model
{
    public function family(){
    	return $this->belongsToMany('App\Family', 'family_realization');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
