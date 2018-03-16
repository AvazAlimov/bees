<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $fillable = [
        'name','volume_name'
    ];

    protected $table ='equipments';
    public function productions(){
        return $this->belongsToMany(Production::class,'produced_equipments');
    }
}
