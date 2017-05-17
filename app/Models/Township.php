<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $fillable = [
        'name',
        'level',
        'county_id',
    ];

    public function county(){
        return $this->belongsTo('App\Models\County');
    }

    public function getListFromCounty($id){
        return $this->where('county_id','=',$id)->get();
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

}
