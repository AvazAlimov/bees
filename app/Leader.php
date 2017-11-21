<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Leader extends Authenticatable
{
    use Notifiable;
    protected $guard = 'leader';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName','lastName', 'email', 'password','username','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function region(){
        return $this->hasOne('App\Region');
    }
    public function users(){
        return $this->hasManyThrough('App\User','App\Region');
    }
    public function acceptedUsers(){
        return $this->users()->where('state',1);
    }
    public function notAcceptedUsers(){
        return $this->users()->where('state',-1);
    }
    public function consideredUsers(){
        return $this->users()->where('state', '!=',0);
    }
    public function waitingUsers(){
        return $this->users()->where('state',0);
    }
}
