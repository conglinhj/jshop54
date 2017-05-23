<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    const ACTIVE = 1;
    const DEACTIVATED = 1;

    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'status', 'avatar', 'render', 'phone', 'facebook_id', 'google_id',
        'city_id', 'county_id', 'township_id', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected  $dates = ['deleted_at'];

    public function dbcart() {
        return $this->hasOne('App\Models\DbCart');
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function product() {
        return $this->belongsToMany(Product::class, 'wishlist', 'user_id')->withTimestamps();
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
    public function county() {
        return $this->belongsTo(County::class);
    }
    public function township() {
        return $this->belongsTo(Township::class);
    }
}
