<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = ['pivot'];
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function realizations(){
        return $this->belongsToMany('App\Realization', 'family_realization');
    }
}
