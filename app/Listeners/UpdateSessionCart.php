<?php

namespace App\Listeners;

use App\Events\SyncDbCartToSessionCart;
use App\Models\DbCart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateSessionCart
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
     * @param  SyncDbCartToSessionCart  $event
     * @return void
     */
    public function handle(SyncDbCartToSessionCart $event)
    {
        $database_bcart = new DbCart;
        $db_cart = $database_bcart->getCartOfUser($event->user->id);
        $ar_db_row_id = $ar_ss_row_id = array();

        foreach (Cart::content() as $ss_item)
        {
            $ar_ss_row_id[] = $ss_item->rowId;
        }

        /**
         * update số lượng của item trong session cart đúng với số lương item trong database cart
         */
        foreach ($db_cart->product as $item)
        {
            $ar_db_row_id[] = $item->pivot->row_id;
            foreach ($ar_ss_row_id as $row_id)
            {
                if ($row_id == $item->pivot->row_id){
                    Cart::update($item->pivot->row_id, $item->pivot->qty);
                }
            }


        }
        /**
         * xóa item có trong session cart
         * mà không có trong database cart
         */
        $ar_ss_diff = array_diff($ar_ss_row_id,$ar_db_row_id);
        foreach ($ar_ss_diff as $row_id){
            Cart::remove($row_id);
        }

        /**
         * thêm vào session cart item
         * có trong database cart
         * nhưng chưa có trong session cart
         */
        $ar_db_diff = array_diff($ar_db_row_id,$ar_ss_row_id);
        foreach ($ar_db_diff as $row_id){

            foreach ($db_cart->product as $item)
            {
                if ($row_id == $item->pivot->row_id){
                    Cart::add([
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'qty' => $item->pivot->qty,
                        'price' => $item['price'],
                        'options' => ['img' => $item['image']]
                    ]);
                }
            }

        }

    }
}
