<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name','email','phone', 'intro','city_id','county_id','township_id','address',
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }
    public function county() {
        return $this->belongsTo(County::class);
    }
    public function township() {
        return $this->belongsTo(Township::class);
    }
    public function phieunhap() {
        return $this->hasMany(PhieuNhap::class);
    }

}
