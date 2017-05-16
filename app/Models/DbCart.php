<?php

namespace App\Models;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class DbCart extends Model
{
    protected $table = "carts";

    protected $fillable = [ 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsToMany(Product::class, 'cart_detail', 'cart_id')
            ->withPivot('row_id', 'qty')
            ->withTimestamps();
    }

    public function getCartOfUser($user_id) {
        return $this->where('user_id','=',$user_id)
            ->with('product')
            ->first();
    }

    public function checkExistItemInPivot($cart_id, $pro_id) {
        return $this->whereHas('product', function($query) use ($cart_id, $pro_id){
            $query->where([
                ['cart_id','=', $cart_id],
                ['product_id','=', $pro_id],
            ]);
        })
            ->with('product')
            ->first();
    }

    /**
     * to pivot table cart_detail
     */
    public function destroyItemInDbCart($pro_id){
        return $this->product()->detach($pro_id, true);
    }

    public function attachToPivot($pro_id, $row_id, $qty){
        return $this->product()->attach($pro_id, ['row_id' => $row_id , 'qty' => $qty], true);
    }

    public function updateToPivot($pro_id, $qty){
        return $this->product()->updateExistingPivot($pro_id, ['qty' => $qty], true);
    }
}
