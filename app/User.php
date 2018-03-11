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
        'reg_date', 'inn', 'mfo', 'address', 'phone','bees_count',
        'email', 'fullName', 'labors', 'username','state','password'
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
    public function families(){
        return $this->belongsToMany('App\Family','breads');
    }
    public function city(){
        return $this->belongsTo('App\City');
    }
    public function region(){
        return $this->belongsTo('App\Region');
    }
    public function typeName(){
        return $this->type == 1 ? 'Юридик корхоналар (МЧЖ, ХК, ҚК)' : ($this->type == 2 ? 'Кўп тармоқли фермер хўжаликлари' :
            ($this->type == 3 ? 'Якка тартибдаги тадбиркор': 'Шаҳсий ёрдамчи хўжалик (Жисмоний Шаҳслар)'));
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function realizations(){
        return $this->hasOne('App\Realizations');
    }
}