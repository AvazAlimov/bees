<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'name'
    ];
    public function cities(){
        return $this->hasMany('App\City');
    }
    public function users(){
        return $this->hasMany('App\User');
    }
    public function leader(){
        return $this->belongsTo('App\Leader');
    }
}
