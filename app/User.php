<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $guard = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id', 'city_id', 'neighborhood', 'subject',
        'reg_date', 'inn', 'mfo', 'address', 'phone',
        'email', 'fullName', 'labors', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function activities(){
        return $this->belongsToMany('App\Activity','works');
    }
    public function city(){
        return $this->belongsTo('App\City');
    }
    public function region(){
        return $this->belongsTo('App\Region');
    }
}
