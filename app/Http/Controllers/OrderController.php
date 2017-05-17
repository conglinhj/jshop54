<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DbCart;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{

    public function store(Request $request, Order $order,DbCart $cart) {
//        dd($request->product_id[0]);
        $this->validator($request);

        $ordered = Order::create($request->all());
        for ($i = 0; $i < count($request->product_id); $i++){
            $order_detail =  $ordered->saveDetails($request->product_id[$i], $request->qty[$i], $request->price[$i]);
        }

        /* xóa giỏ hàng sau khi order */
        $db_cart = $cart->getCartOfUser(Auth::id());
        $db_cart->product()->detach();
        Cart::destroy();

        return redirect(route('my.order', ['id' => $ordered->id]));
    }

    public function validator($request) {
        $rules = [
            'customer_name' => 'required',
            'city_id' => 'not_in:0',
            'county_id' => 'not_in:0',
            'township_id' => 'not_in:0',
            'address' => 'required',
            'phone' => 'required|digits_between:9,16|numeric',
        ];
        $messages = [
            'customer_name.required' => 'Mời quý khách nhập tên thật của mình.',
            'address.required' => 'Không được để trống.',
            'county_id.not_in' => 'Mời quý khách chọn một',
            'phone.required' => 'Không được để trống.',
            'phone.digits_between' => 'Nhập đúng số điện thoại của quý khách',
            'phone.numeric' => 'Số điện thoại phải là số',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();
    }

}
