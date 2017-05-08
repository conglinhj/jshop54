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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
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
    public function shop(Product $product, Trademark $trademark)
    {
        $products = $product->getAllStatus();
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
        $product_details = $product->getDetailStatus($request->pro_id);
//        dd($product_details);
        return view('frontend.pages.singleProduct',compact('hardwares', 'product_details'));
    }

    /**
     * @param Request $request
     * @param County $county
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountyFromCity(Request $request, County $county){
        $counties = $county->getListFromCity($request->city_id);
        return response()->json( compact('counties') );
    }

    public function getTownshipFromCounty(Request $request, Township $township){
        $townships = $township->getListFromCounty($request->county_id);
        return response()->json( compact('townships') );
    }

    public function getProductOfTrademark(Product $product, Request $request){
        $products = $product->getProductsOfTrademark($request->tra_id);
        return view('frontend.pages.trademark-product', compact('products'));
    }

}
