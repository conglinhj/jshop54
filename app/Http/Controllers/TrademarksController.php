<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Trademark;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Parser\Reader;

class TrademarksController extends Controller
{

    /**
     * show Trademark list
     * @param Trademark $trademark
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function index(Trademark $trademark)
    {
        $list_trademarks = $trademark->getAll();
        return view('backend.trademarks.lists',[
            'list_trademarks' => $list_trademarks,
        ]);
    }

    /**
     * get details of Trademark has $id
     * @param Trademark $trademark
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Trademark $trademark, $id)
    {
        $details_trademark = $trademark->viewDetail($id);
        return view('backend.trademarks.view',[
            'details_trademark' => $details_trademark,
        ]);
    }

    /**
     * show create form, create new trademark
     */
    public  function showCreateForm()
    {
        return view('backend.trademarks.create');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:trademarks',
//            'brand' => 'mimes:jpeg,png,jpg',
        ]);
        $trademark = Trademark::create($request->all());
        return redirect(route('backend.trademarks.view',['id' => $trademark['id']]))->with('created_message','Created !');
    }

    /**
     * show edit form with trademark $id, update trademark
     */
    public function showEditForm(Trademark $trademark,$id)
    {
        $details_trademark = $trademark->viewDetail($id);
        return view('backend.trademarks.edit',[
            'details_trademark' => $details_trademark
        ]);
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        $trademark = Trademark::findOrFail($request->id);
        $trademark->update($request->all());

        return redirect(route('backend.trademarks.view',[ 'id' => $request->id ]))->with('updated_message','Updated !');
    }

//    protected function validator(array $data)
//    {
//        return Validator::make($data, [
//            'name' => 'required|max:255',
//        ]);
//    }

    /**
     * delete trademark in Database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Product $product)
    {
        $trademark = Trademark::findOrFail($request->trademark_id);
        $products = $product->where('trademark_id','=',$request->trademark_id)->get();
        if (count($products) != 0){
            return redirect()->back()->with('delete_message','Không thể xóa.');
        }
        $trademark->delete();
        return redirect(route('backend.trademarks.list'))->with('trademark_deleted','Deleted!');
    }

}
