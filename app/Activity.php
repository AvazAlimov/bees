<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
