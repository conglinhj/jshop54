<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'level',
    ];

    public function county() {
        return $this->hasMany('App\Models\County','city_id');
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function user() {
        return $this->hasMany(User::class);
    }

    public function provider() {
        return $this->hasMany(Provider::class);
    }

}
