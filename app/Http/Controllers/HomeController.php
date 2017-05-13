<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;
use App\Models\Hardware;
use App\Models\Specs;
use App\Models\Administration;
use App\Models\City;
use App\Models\County;
use App\Models\Township;
use Illuminate\Support\Facades\View;

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
        return view('frontend.pages.home');
    }

    /**
     * list all product
     */
    public function shop(Product $product, Request $request)
    {
        if (isset($request->trademark)){
            $products = $product->getProductsOfTrademark($request->trademark);
            if ($request->ajax()){
                return view('frontend.pages.filter',compact('products'));
            }
        }
        $products = $product->activating();
        return view('frontend.pages.shop',compact('products'));
    }

    public function checkOut()
    {
        $cities = City::all();
        return view('frontend.pages.checkout', compact('cities'));
    }

    public function singleProduct(Request $request, Hardware $hardware, Product $product)
    {
        $hardwares = $hardware->getAll();
        $product_details = $product->getDetailProductActivating($request->pro_id);
        return view('frontend.pages.singleProduct',compact('hardwares', 'product_details'));
    }

    /**
     * search product name
     */
    public function searchProduct(Product $product, Request $request) {
        $this->validate($request, [
            'key_search' => 'required',
        ]);
//        dd($request->key_search);
        $result_product = $product->searchProductActivating($request->key_search);
        return view('frontend.pages.result-search', compact('result_product'));
    }

    /**
     * get product with trademark
     */
    public function getProductOfTrademark(Product $product, Request $request){
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

}
