<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Events\SyncDbCartToSessionCart;
use Illuminate\Support\Facades\Validator;

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

    public function myProfile(){
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        $user = User::where('id','=',Auth::id())->with('city','county','township')->first();
        return view('frontend.pages.my-profile',compact('user'));
    }

    public function showProfileEditForm() {
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        $user = User::where('id','=',Auth::id())->with('city','county','township')->first();
        return view('frontend.pages.edit-my-profile',compact('user'));
    }

    public function editMyProfile(Request $request, User $user) {
        $this->validator($request);
        $user = $user::find(Auth::id());
        $user->update($request->all());

        return redirect(route('my.profile'));
    }

    public function validator($request) {
        $rules = [
            'name' => 'required',
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

    public function listOrder() {
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
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
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        $user_id = Auth::id();
        $products = Product::whereHas('user', function ($query) use ($user_id){
            $query->where('user_id','=',$user_id);
        })->latest()->paginate();
        return view('frontend.pages.wishlist',compact('products'));
    }

    /**
     *  for backend
     */
    public function listAll(User $user) {
        $users = $user::with('city')->paginate();
        return view('backend.customer.list', compact('users'));
    }

    public function viewDetail(User $user, Request $request) {
        $detail_user = $user::where('id', '=', $request->id)->with('city','county','township','order')->first();
        return view('backend.customer.view', compact('detail_user'));
    }

    public function changeStatus(Request $request){
        $user = User::find($request->proId);
        $user->status = $request->status;
        $user->save();
    }

    public  function destroy (Request $request, User $user, Order $order) {
        $user_detail = $user->find($request->user_id);
        $orders = $order->where('user_id','=',$request->user_id)->get();
        if (count($orders)!= 0){
            $ar_orId = array();
            foreach ($orders as $item){
                $ar_orId[] = $item->id;
            }
            return redirect()->back()->with('delete_message', 'Không thể xóa, người dùng này có dữ liệu ở đơn hàng có mã '.implode(', ',$ar_orId));
        }
        $user_detail->delete();
        return redirect()->route('backend.customer.list')->with('deleted_message', 'Đã xóa người dùng có id '.$request->user_id);
    }

}
