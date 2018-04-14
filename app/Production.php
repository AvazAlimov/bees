<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table ='productions';
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function equipments(){
        return $this->belongsToMany(Equipment::class,'produced_equipments')
            ->orderBy('equipment_id','asc')->withPivot('volume');
    }

}
