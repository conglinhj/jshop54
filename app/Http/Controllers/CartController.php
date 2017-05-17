<?php

namespace App\Http\Controllers;

use App\Events\SyncDbCartToSessionCart;
use App\Models\Product;
use App\Models\DbCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartController extends Controller
{

    public function __construct()
    {
        //
    }

    public function cart(){
        if (Auth::check())self::eventSyncCart();
        return view('frontend.pages.cart');
    }

    /**
     * lấy giỏ hàng của user có id = $id
     */
    public function CartOfUser($id){
        $dbcart = new DbCart;
        return $db_cart = $dbcart->getCartOfUser($id);
    }

    /**
     * thêm 1 sản phẩm vào giỏ hàng
     */
    public function addItem(Product $product, $id)
    {
        $product_details = $product->find($id);
        $cartItem = Cart::add([
                'id' => $product_details['id'],
                'name' => $product_details['name'],
                'qty' => 1,
                'price' => $product_details['price'],
                'options' => ['img' => $product_details['image']]
        ]);
        if (Auth::check()){
            $this->saveToDbCart($cartItem->rowId);
        }
        return redirect(route('cart'));
    }

    /**
     * tăng giảm số lượng của sản phẩm trong giỏ hàng
     */
    public function updateItem(Request $request){
        if ($request->cal == '-'){
            $cartItem = Cart::update($request->id, $request->qty-1);
        }else if ($request->cal == '+'){
            $cartItem = Cart::update($request->id,$request->qty+1);
        }

        if (Auth::check()){
            $this->saveToDbCart($cartItem->rowId);
        }
    }

    /**
     * lưu giỏ hàng vào database
     */
    public function saveToDbCart($row_id) {
        //lấy giỏ hàng của user đang dăng nhập
        $dbcart = new DbCart;
        $db_cart = self::CartOfUser(Auth::id());
        //cập nhật or tạo mới item có id = $pro_id vào bảng cart_detail
        $cart_item = Cart::get($row_id);
        //kiểm tra xem item đã có trong giỏ hàng chưa
        $check = $dbcart->checkExistItemInPivot($db_cart ->id, $cart_item->id);
        if( $check ){
            // nếu đã có item thì update
            $db_cart->updateToPivot($cart_item->id, $cart_item->qty);
        } else {
            // nếu chưa có item thì attach
            $db_cart->attachToPivot($cart_item->id, $row_id, $cart_item->qty);
        }

    }

    /**
     * xóa 1 sản phẩm trong giỏ hàng
     */
    public function removeItem(Request $request, DbCart $dbcart){

        if (Auth::check()){
            $cart_item = Cart::get($request->row_id);
            $db_cart = self::CartOfUser(Auth::id());
            $db_cart->destroyItemInDbCart($cart_item->id);
            Cart::remove($request->row_id);
        }else {
            Cart::remove($request->row_id);
        }
    }

    public function eventSyncCart(){
        $authCurrent = User::find(Auth::id());
        event(new SyncDbCartToSessionCart($authCurrent));
    }

}
