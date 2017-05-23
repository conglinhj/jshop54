<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;
use App\Models\Hardware;
use App\Models\City;
use App\Models\County;
use App\Models\Township;
use Illuminate\Support\Facades\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\SyncDbCartToSessionCart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $trademark_oj = new Trademark;
        $trademarks = $trademark_oj->activating();
        View::share(compact('trademarks'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        return view('frontend.pages.home');
    }

    /**
     * list all product
     */
    public function shop(Product $product, Request $request)
    {
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        $products = $product->isActive();
        if ($request->key) {
            $products = self::searchProduct($request);
        }
        return view('frontend.pages.shop',compact('products'));
    }

    public function ProductOfCategory(Product $product, Request $request) {
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        $products = $product->isActiveOfCategory($request->category_id);
        if ($request->trademark){
            $products = $product->getProductsOfTrademarkAndCategory($request->category_id, $request->trademark);
        }
        if ($request->price){
            $products = $product->getProductWithPrice($request->category_id, $request->price);
        }
        return view('frontend.pages.shop',compact('products'));
    }



    public function singleProduct(Request $request, Hardware $hardware, Product $product)
    {
        $hardwares = $hardware->getAll();
        $product_details = $product->getDetailProductIsActive($request->pro_id);
        return view('frontend.pages.singleProduct',compact('hardwares', 'product_details'));
    }

    /**
     * get product with trademark
     */
    public function getProductOfTrademark(Product $product, Request $request){
        if (Auth::check()){
            $authCurrent = User::find(Auth::id());
            event(new SyncDbCartToSessionCart($authCurrent));
        }
        $products = $product->getProductsOfTrademark($request->tra_id);
        return view('frontend.pages.trademark-product', compact('products'));
    }


    /**
     * from ajax
     * get County and Township
     */
    public function getCountyFromCity(Request $request, County $county){
        $counties = $county->getListFromCity($request->city_id);
        return response()->json( compact('counties') );
    }
    public function getTownshipFromCounty(Request $request, Township $township){
        $townships = $township->getListFromCounty($request->county_id);
        return response()->json( compact('townships') );
    }

    /**
     * search product name
     */
    public function searchProduct(Request $request) {
        $this->validate($request, [
            'key' => 'required',
        ]);
        $product = new Product;
        return $products = $product->searchProductIsActive($request->key);
    }

}
