<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realization extends Model
{
    public function family(){
    	return $this->belongsToMany('App\Family', 'family_realization');
    }
}
