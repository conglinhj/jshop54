<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function myOrder($id) {
        $order = new Order;
        $order_detail = $order->getDetails($id, Auth::id());
        return view('frontend.pages.order-detail', compact('order_detail'));
    }

    public function myProfile(Request $request){
//        dd($request->id);
        $user = User::find($request->id);
        return view('frontend.pages.my-profile',compact('user'));
    }
    public function listOrder() {
        $order = new Order;
        $orders = $order->getListOrderOfUserCurrent(Auth::id());
         return view('frontend.pages.my-orders',compact('orders'));
    }

    public function addWishList(Request $request) {
        $user = new User;
        $user_detail = $user->where('id','=',Auth::id())->first();
        $wishlist = $user_detail->product()->attach($request->proId);
    }

    public function removeWishList(Request $request) {
        $user = new User;
        $user_detail = $user->where('id','=',Auth::id())->first();
        $wishlist = $user_detail->product()->detach($request->proId);
    }

    public function wishList(){
        $user_id = Auth::id();
        $products = Product::whereHas('user', function ($query) use ($user_id){
            $query->where('user_id','=',$user_id);
        })->paginate();
        return view('frontend.pages.wishlist',compact('products'));
    }
}
