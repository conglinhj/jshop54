<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        return view('frontend.pages.cart');
    }
    public function addItem(Product $product, $id)
    {
        $product_details = $product->find($id);
        Cart::add([
                'id' => $product_details['id'],
                'name' => $product_details['name'],
                'qty' => 1,
                'price' => $product_details['price'],
                'options' => ['img' => $product_details['image']]
        ]);
        return redirect(route('cart'));
    }

    public function removeItem(Request $request){
        Cart::remove($request->id);
    }
    public function updateItem(Request $request){
        if ($request->cal == '-'){
            Cart::update($request->id, $request->qty-1);
        }else if ($request->cal == '+'){
            Cart::update($request->id,$request->qty+1);
        }
    }
}
