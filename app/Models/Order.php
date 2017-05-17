<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\SyncDbCartToSessionCart;
use Illuminate\Support\Facades\Auth;


class Order extends Model
{
    protected $fillable = [ 'user_id', 'customer_name', 'phone', 'city_id', 'county_id', 'township_id', 'address', 'note', ' shipped_at' ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id')->withPivot('quantity', 'price', 'discount');
    }

    public function saveDetails($pro_id, $qty, $price, $discount = 0) {
        return $this->product()->attach($pro_id, ['quantity' => $qty, 'price' => $price,'discount' => $discount]);
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

    /*frontend*/
    public function getDetails($id, $user_id){
        return $this->where([
                ['id','=', $id],
                ['user_id', '=', $user_id]
            ])
            ->with(['city','county', 'township','product'])
            ->first();
    }

    public function getListOrderOfUserCurrent($user_id){
        return $this->where('user_id','=',$user_id)->get();
    }

}
