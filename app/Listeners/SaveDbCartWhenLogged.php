<?php

namespace App\Listeners;

use App\Events\MergeCart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\DbCart;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveDbCartWhenLogged
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MergeCart  $event
     * @return bool
     */
    public function handle(MergeCart $event)
    {
        $user = $event->user;

        //lấy giỏ hàng của user đang dăng nhập, nếu không có thì tạo mới
        $db_oj_cart = new DbCart;
        $db_cart = $db_oj_cart::firstOrCreate(['user_id' => $user->id]);
        foreach ($db_cart->product as $item){
            Cart::add([
                'id' => $item['id'],
                'name' => $item['name'],
                'qty' => $item->pivot->qty,
                'price' => $item['price'],
                'options' => ['img' => $item['image']]
            ]);
        }

        foreach (Cart::content() as $item){

            //cập nhật or tạo mới item có id = $pro_id vào bảng cart_detail
            $check = $db_oj_cart->checkExistItemInPivot($db_cart ->id, $item->id);
            if( $check ){
                // nếu đã có item thì update
                $db_cart->updateToPivot($item->id, $item->qty);
            } else {
                // nếu chưa có item thì attach
                $db_cart->attachToPivot($item->id, $item->rowId, $item->qty);
            }
        }
        return true;
    }
}
