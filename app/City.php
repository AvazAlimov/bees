<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
       'id','name','region_id'
    ];
    public function region(){
        return $this->belongsTo('App\Region');
    }
    public function user(){
        return $this->hasMany('App\User');
    }
}
