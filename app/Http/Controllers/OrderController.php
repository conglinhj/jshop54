<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Validator;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DbCart;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function checkOut()
    {
        return view('frontend.pages.checkout');
    }

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

    /* for backend */

    public function index(Request $request, Order $order) {
        $orders = $order->where('status', '=', 0)->with('user')->latest()->paginate(20);
        if ($request->status){
            if ($request->status == 10){
                $orders = $order->with('user')->latest()->paginate(20);
            } else{
                $orders = $order->where('status', '=', $request->status)->with('user')->latest()->paginate(20);
            }
        }
        if ($request->order_id){
            $this->validate($request,['order_id' => 'required']);
            $orders = $order->where('id','=',$request->order_id)->latest()->paginate();
        }
        if ($request->date){
            $orders = $order->where('created_at','like',$request->date.'%')->latest()->paginate();
        }

        return view('backend.order.list',compact('orders'));
    }
    public function view(Request $request, Order $order) {

        if ( $request->ajax() ){
            return response()->json([
                'order_detail' => $order->where('id', '=', $request->id)
                    ->with('city','county','township','user', 'product')
                    ->first()
            ], 200);
        }
        $order_detail = $order->where('id', '=', $request->id)
            ->with('city','county','township','user', 'product')
            ->first();

        return view('backend.order.view', compact('order_detail'));

    }
    public function changeStatus(Request $request, Order $order, Product $product) {
        $order_details = $order->find($request->id);
        $order_details->status = $request->status;
        $order_details->save();

        if ($order_details->status == 1){
            foreach ($order_details->product as $item){
                $product_d = $product->find($item->id);
                $product_d->quantity = $product_d->quantity - $item->pivot->quantity;
                $product_d->save();
            }
        }

        return response()->json([
            'order' => $order_details
        ], 200);
    }

}
