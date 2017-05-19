<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Trademark;
use App\Models\Category;
use App\Models\Specs;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function __construct()
    {

    }
    public  function index(Product $product, Request $request){
        $list_products = $product->getAll();
        if ($request->type){
            if ($request->type != 2 ){
                $list_products = $product->getListWithType($request->type);
            }
        }
        if ($request->category){
            if ($request->category != 0){
                $list_products = $product->getListWithCategory($request->category);
            }
        }


        return view('backend.products.list',[
            'list_products' => $list_products,
        ]);
    }

    public function view(Product $product, $id, Hardware $hardware){
        $hardwares = $hardware->getAll();
        $details_product = $product->getDetail($id);
//        dd($details_product);
        return view('backend.products.view',[
            'hardwares' => $hardwares,
            'details_product' => $details_product,
        ]);
    }

    public function showCreateForm(Trademark $trademark, Hardware $hardware){
        $trademarks = $trademark->getAll();
        $hardwares = $hardware->getAll();
        return view('backend.products.create',[
            'trademarks' => $trademarks,
            'hardwares' => $hardwares,
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:products',
            'trademark_id' => 'required',
        ]);
        $product = Product::create($request->all());
        if($request->has('specs_id') && $request->has('value')){
            $pro_specs = array();
            foreach ($request->specs_id as $key => $specs_id){
                foreach ($request->value as $key2 => $value){
                    if ($key == $key2){
                        $specs_value['value'] = $value;
                        $pro_specs[$specs_id] = $specs_value;
                    }
                }
            }
            $product->storeToPivotTable($pro_specs);
        }
        return redirect(route('backend.products.view',['id' => $product['id'] ]))->with('created_message','Created !');
    }

    public function showEditForm(Trademark $trademark, Product $product, Hardware $hardware, $id){
        $details_product = $product->getDetail($id);
        $trademarks = $trademark->getAll();
        $hardwares = $hardware->getAll();
//        dd($details_product->pivot);
        return view('backend.products.edit',[
            'trademarks' => $trademarks,
            'hardwares' => $hardwares,
            'details_product' => $details_product,
        ]);
    }

    public function update(Product $product,Request $request){
        $this->validate($request,[
            'name' => 'required',
            'trademark_id' => 'required',
        ]);
        $details_product = $product::findOrFail($request->id);
        $details_product->update($request->all());
        if($request->has('specs_id') && $request->has('value')){
            foreach ($request->specs_id as $key => $specs_id){
                foreach ($request->value as $key2 => $value){
                    if ($key == $key2){
                        $details_product->updateToPivotTable($specs_id,$value);
                    }
                }
            }
        }
        return redirect(route('backend.products.view',['id' => $details_product['id'] ]))->with('updated_message','Updated !');
    }

    public function changeStatus(Request $request){
        $product = Product::find($request->proId);
        $product->status = $request->status;
        $product->save();
    }

    public function destroy(Specs $specs, Request $request){
        $product = Product::FindOrFail($request->product_id);

        // detach to product_specs table
        // step 1 : destroy to product_specs table.
        $specs_list =  $specs->getListId();
        $specsId_list = array();
        foreach ($specs_list as $spe_id){
            $specsId_list[] = $spe_id['id'];
        }
        $product->destroyToPivotTable($specsId_list);
        // step 2 : destroy to product_specs table.
        $product->delete();

        return redirect(route('backend.products.list'))->with('deleted_message','Deleted !');
    }

}
