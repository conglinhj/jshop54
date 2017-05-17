<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = [
        'name',
        'level',
        'city_id',
    ];

    public function city() {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function township() {
        return $this->hasMany('App\Models\Township');
    }

    public  function getListFromCity($city_id) {
        return $this->where('city_id','=',$city_id)->get();
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

}
