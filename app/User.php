<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id', 'city_id', 'neighborhood', 'subject',
        'reg_date', 'inn', 'mfo', 'address', 'phone',
        'email', 'fullName', 'labors', 'username','state',
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
    public function typeName(){
        return $this->type == 1 ? 'Корхона/ЯТТ' : ($this->type == 2 ? 'Кўп тармоқли фермер хўжаликлари' :
            ($this->type == 3 ? 'Деҳқон (шахсий ёрдамчи) хўжаликлари': 'Жисмоний шахс'));
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
